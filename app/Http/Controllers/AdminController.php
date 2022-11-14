<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\SocialMediaLink;
use Carbon\Carbon;
use App\DeviceId;
use App\Customer;
use App\Mining;
use App\Admin;
use App\Misc;
use App\Faq;
use DB;

class AdminController extends Controller
{
    public function login()
    {
    	return view('admin.login');
    }

    public function login_submit(Request $request)
    {
        $this->validate($request, [
        'email' => 'required',
        'password' => 'required',
        ]);
        
        $admin = Admin::where(['email' => $request->email])->first();
		
		if($admin)
		{
			if(Auth::guard('admin')->attempt(['email'=> $request->email, 'password' => $request->password]))
			{
				return redirect('/dashboard');
			}
            else
            {
                return redirect('/')->with('error_msg', 'Invalid Credentials!');
            }
        }
        else
        {
            return redirect('/')->with('error_msg', 'You are not authorized!');
        }
    }

    public function dashboard()
    {
        $total_coins_mined_today = $users_joined_today = DB::select(DB::raw("SELECT COALESCE(SUM(coins),0) as total_coins_mined_today FROM minings WHERE DATE_FORMAT(created_at,'%e %c %Y') = DATE_FORMAT(now(),'%e %c %Y')"));
        $all_users = Customer::count();
        $active_users = Customer::where('status','=',1)->count();
        $blocked_users = Customer::where('status','=',0)->count();
        $total_coins_mined = Mining::sum('coins');
        $users_joined_today = DB::select(DB::raw("SELECT COALESCE(count(id),0) as total_users FROM customers WHERE DATE_FORMAT(created_at,'%e %c %Y') = DATE_FORMAT(now(),'%e %c %Y')"));
        $customer = Customer::orderBy('total_coins', 'DESC')->first();

        return view('admin.dashboard',compact('all_users','active_users','blocked_users','total_coins_mined','users_joined_today','customer','total_coins_mined_today'));
    }
    
    public function chart_mining(Request $request)
    {
        $months = [];
        $coins_mined = [];
        
        for($i=0;$i<12;$i++)
        {
            $month = Carbon::now()->addMonths(-1*$i)->format('M Y');
            
            $coins_mined_per_month = DB::select(DB::raw("SELECT COALESCE(SUM(coins),0) as coins_mined_per_month FROM minings WHERE DATE_FORMAT(created_at,'%b %Y') = '$month'"));
            
            array_push($coins_mined,$coins_mined_per_month[0]->coins_mined_per_month);
            array_push($months,$month);
        }
        
        $chart_coins = array(
            'months'=> $months,
            'coins_mined'=> $coins_mined
        );

        return $chart_coins;
    }

    public function logout()
    {
    	Auth::logout();
    	return redirect('/');
    }

    public function forgot_password()
    {
        return view('admin.forgot_password');
    }

    public function forgot_password_submit(Request $request)
    {
        $email = $request->email;
       
        $user = Admin::whereEmail($email)->first();
        if($user != '') 
        {
            $token = \Str::random(10);
            $user->token = $token;
            $user->save();

            $to = $user->email;
            $from = 'no-reply@gelera.com';
            $subject = 'Password Recovery';
            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
            $headers .= 'From: no-reply@gelera.com'."\r\n".
            'Reply-To: no-reply@gelera.com'. "\r\n" .
            'X-Mailer: PHP/' . phpversion();
            $message = '<p>Please click the link to rest your password <a href="https://geleracurrency.com/reset_password/'.$token.'" target="_blank">Click here</a></p>';
            mail($to, $subject, $message, $headers);

            return response()->json(['success_msg'=> "Email sent successfully..!"]);
        }
        else
        {
            return response()->json(['error_msg'=> 'Unable to send email']);
        }
    }

    public function change_password()
    {
        return view('admin.change_password');
    }
    
    public function change_password_submit(Request $request)
    {
        $rules = [
            'current_password' => 'required',
            'new_password' => 'required',
            'password_confirmation' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return redirect()->back()->with('error_msg',$validator->errors()->first());
        }

        $admin = Auth::user();
        
        if(!($request->new_password == $request->password_confirmation)){
            return redirect()->back()->with('error_msg','Your mew password does not matches with the confirm new password. Please try again.');
        }
        else if (!(password_verify($request->current_password, $admin->password)))
        {
            return redirect()->back()->with('error_msg','Your current password does not matches with the password you provided. Please try again.');
        }
        else
        {
            $admin->password = Hash::make($request->new_password);
            $admin->save();
            
            return redirect()->back()->with('success_msg','Password changed successfully !');
        }
    }

    public function all_users()
    {
        $users = Customer::get();
        return view('admin.all_users',compact('users'));
    }

    public function active_users()
    {
        $users = Customer::where('status','=',1)->get();
        return view('admin.active_users',compact('users'));
    }

    public function blocked_users()
    {
        $users = Customer::where('status','=',0)->get();
        return view('admin.blocked_users',compact('users'));
    }

    public function disable_user($id)
    {
        $user = Customer::where('id','=',$id)->first();
        $user->status = 0;
        $user->save();

        return redirect()->back()->with('success_msg','User disabled successfully');
    }
    
    public function activate_user($id)
    {
        $user = Customer::where('id','=',$id)->first();
        $user->status = 1;
        $user->save();

        return redirect()->back()->with('success_msg','User activated successfully');
    }

    public function send_notification()
    {
        return view('admin.send_notification');
    }

    public function send_notification_submit(Request $request)
    {
        $rules = [
            'title' => 'required',
            'notification' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return redirect()->back()->with('error_msg',$validator->errors()->first());
        }

        $device_id = DeviceId::get();

        foreach ($device_id as $device_id) {
            
            $url = "https://fcm.googleapis.com/fcm/send";

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            $headers = array(
               "Accept: application/json",
               "Content-Type: application/json",
               "Authorization: key=AAAAHc95CfM:APA91bG60PODK03fnN0a3yX0cIQP6nXcSX2qtKPOI8ImLH6jMgp1903Zu3q5wWzN5B3XwgkiFXvxn4FxMffHU5lUJNX1ccA5A-g--DhkaUpb61VWDik07Jgr6WKB1WVdzzJzXQnJPEH1",
            );
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

            $data = '{
                "to" : "'.$device_id->device_id.'",
                "notification" : {
                    "body" : "'.$request->notification.'",
                    "title": "'.$request->title.'"
                }
            }';

            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

            $resp = curl_exec($curl);
            curl_close($curl);
        }

        return redirect()->back()->with('success_msg','Notification sent successfully');
    }

    public function daily_coins_limit()
    {
        $misc = Misc::where('id','=',1)->first();
        return view('admin.daily_coins_limit',compact('misc'));
    }

    public function referal_bonus()
    {
        $misc = Misc::where('id','=',1)->first();
        return view('admin.referal_bonus',compact('misc'));
    }

    public function coins_per_click()
    {
        $misc = Misc::where('id','=',1)->first();
        return view('admin.coins_per_click',compact('misc'));
    }

    public function daily_coins_limit_submit(Request $request)
    {
        $rules = [
            'daily_coins_limit' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return redirect()->back()->with('error_msg',$validator->errors()->first());
        }

        $misc = Misc::where('id','=',1)->first();
        $misc->daily_limit = $request->daily_coins_limit;
        
        if($misc->save())
        {
            return redirect()->back()->with('success_msg','Daily coins limit updated successfully');
        }
        else
        {
            return redirect()->back()->with('error_msg','Unable to update daily coins limit');
        }

        return view('admin.daily_coins_limit');
    }

    public function referal_bonus_submit(Request $request)
    {
        $rules = [
            'referal_bonus' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return redirect()->back()->with('error_msg',$validator->errors()->first());
        }

        $misc = Misc::where('id','=',1)->first();
        $misc->referal_bonus = $request->referal_bonus;
        
        if($misc->save())
        {
            return redirect()->back()->with('success_msg','Referal bonus updated successfully');
        }
        else
        {
            return redirect()->back()->with('error_msg','Unable to update referal bonus');
        }

        return view('admin.referal_bonus');
    }

    public function coins_per_click_submit(Request $request)
    {
        $rules = [
            'coins_per_click' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return redirect()->back()->with('error_msg',$validator->errors()->first());
        }

        $misc = Misc::where('id','=',1)->first();
        $misc->default_mining_rate = $request->coins_per_click;
        
        if($misc->daily_limit < $request->coins_per_click)
        {
            return redirect()->back()->with('error_msg','Coins per click can not exceed daily limit');
        }

        if($misc->save())
        {
            return redirect()->back()->with('success_msg','Coins per click updated successfully');
        }
        else
        {
            return redirect()->back()->with('error_msg','Unable to update coins per click');
        }

        return view('admin.coins_per_click');
    }

    public function social_media_links()
    {
        $social_media_link = SocialMediaLink::where('id','=',1)->first();
        return view('admin.social_media_links',compact('social_media_link'));
    }

    public function social_media_links_submit(Request $request)
    {
        $social_media_link = SocialMediaLink::where('id','=',1)->first();
        $social_media_link->twitter = $request->twitter;
        $social_media_link->facebook = $request->facebook;
        $social_media_link->linkedin = $request->linkedin;
        $social_media_link->instagram = $request->instagram;
        $social_media_link->discord = $request->discord;
        $social_media_link->google = $request->google;
        $social_media_link->youtube = $request->youtube;
        $social_media_link->vimeo = $request->vimeo;
        $social_media_link->pinterest = $request->pinterest;
        
        if($social_media_link-> save())
        {
            return redirect()->back()->with('success_msg','Social media links updated successfully');
        }
        else
        {
            return redirect()->back()->with('error_msg','Unable to update social media links');
        }
    }

    public function coin_price()
    {
        $misc = Misc::where('id','=',1)->first();
        return view('admin.coin_price',compact('misc'));
    }
    
    public function coin_price_submit(Request $request)
    {
        $rules = [
            'coin_price' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return redirect()->back()->with('error_msg',$validator->errors()->first());
        }

        $misc = Misc::where('id','=',1)->first();
        $misc->coin_price = $request->coin_price;

        if($misc->save())
        {
            return redirect()->back()->with('success_msg','Coin price updated successfully');
        }
        else
        {
            return redirect()->back()->with('error_msg','Unable to update coin price');
        }
    }

    public function reset_password($token)
    {
        $admin = Admin::where('token','=',$token)->first();

        if($admin)
        {
            return view('admin.reset_password');
        }
        else
        {
            return abort(403, 'Token Expired. Please Try Again..!');
        }
    }
    
    public function reset_password_submit(Request $request)
    {
        $rules = [
            'new_password' => 'required',
            'confirm_new_password' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return redirect()->back()->with('error_msg',$validator->errors()->first());
        }

        if(!($request->new_password == $request->confirm_new_password)){
            return redirect()->back()->with('error_msg','Your new password does not matches with the confirm new password. Please try again.');
        }
        $admin = Admin::where('id','=',1)->first();
        $admin->password = Hash::make($request->new_password);
        $admin->token = NULL;
                
        if($admin->save())
        {
            return redirect('/')->with('success_msg','Password reseted successfully..!');
        }
        else
        {
            return redirect()->back()->with('error_msg','Unable to reset password. Try Again');
        }
    }

    public function terms_of_service()
    {
        return view('admin.terms_of_service');
    }
    
    public function privacy_policy()
    {
        return view('admin.privacy_policy');
    }

    public function view_faqs()
    {
        $faqs = Faq::get();
        return view('admin.view_faqs',compact('faqs'));
    }

    public function edit_faq($id)
    {
        $faq = Faq::where('id','=',$id)->first();
        return view('admin.edit_faq',compact('faq'));
    }

    public function update_faq(Request $request)
    {
        $rules = [
            'faq_id' => 'required',
            'question' => 'required',
            'answer' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return redirect()->back()->with('error_msg',$validator->errors()->first());
        }

        $faq = Faq::where('id','=',$request->faq_id)->first();

        $faq->question = $request->question;
        $faq->answer = $request->question;

        if($faq->save())
        {
            return redirect()->back()->with('success_msg','Faq updated successfully');
        }
        else
        {
            return redirect()->back()->with('error_msg','Unable to update faq');
        }
    }

    public function add_faq()
    {
        return view('admin.add_faq');
    }

    public function submit_add_faq(Request $request)
    {
        $rules = [
            'question' => 'required',
            'answer' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return redirect()->back()->with('error_msg',$validator->errors()->first());
        }

        $faq = Faq::create([
            'question' => $request->question,
            'answer' => $request->answer
        ]);

        if($faq)
        {
            return redirect()->back()->with('success_msg','Faq Added successfully');
        }
        else
        {
            return redirect()->back()->with('error_msg','Unable to add Faq');
        }
    }

    public function delete_faq($id)
    {
        $faq = Faq::where('id','=',$id)->delete();
        return redirect()->back()->with('success_msg','Faq deleted successfully');
    }

    public function faqs()
    {
        $faqs = Faq::get();
        return view('admin.faqs',compact('faqs'));
    }
}
