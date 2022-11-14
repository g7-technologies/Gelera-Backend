<?php

namespace App\Http\Controllers\API;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Database;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase;
use App\Customer;
use App\DeviceId;
use App\Mining;
use App\Misc;
use DB;

class CustomerController extends Controller
{
    public function customer_login(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
            'device_id' => 'required'
        ];
        
        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return response()->json(['error'=> true, 'error_msg' => $validator->errors()->first()]);
        }
        
        $customer = Customer::where('email','=',$request->email)->first();
        
        if($customer)
        {
            if($customer->status == 0)
            {
                return response()->json(['error'=> true, 'error_msg' => 'You have been blocked please contact administrator.']);
            }
            else
            {
                if(password_verify($request->password, $customer->password))
                {
                    $mining = DB::select(DB::raw("SELECT COALESCE(SUM(coins),0) as coins_mined FROM minings WHERE customer_id = '$customer->id' AND DATE_FORMAT(created_at,'%e %c %Y') = DATE_FORMAT(now(),'%e %c %Y')"));
                    $misc = Misc::where('id','=',1)->first();

                    $device_id = DeviceId::create([
                        'customer_id' => $customer->id,
                        'device_id' => $request->device_id
                    ]);

                    if($device_id)
                    {
                        return response()->json(['error' => false, 'misc' => $misc, 'user' => $customer, 'mined_today' => $mining[0]->coins_mined, 'success_msg' => 'Logged In successfully']);
                    }
                    else
                    {
                        return response()->json(['error' => true,'error_msg' => 'Unable to login please try again']);
                    }
                }
                else
                {
                    return response()->json(['error' => true,'error_msg' => 'Login failed, invalid credentials']);
                }
            }
        }
        else
        {
            return response()->json(['error' => true,'error_msg' => 'No User Found..!']);
        }
    }

    public function Dashboard_data(Request $request)
    {
        $rules = [
            'customer_id' => 'required'
        ];
        
        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return response()->json(['error'=> true, 'error_msg' => $validator->errors()->first()]);
        }
        
        $customer = Customer::where('id','=',$request->customer_id)->first();
        
        if($customer)
        {
            if($customer->status == 0)
            {
                return response()->json(['error'=> true, 'error_msg' => 'You have been blocked please contact administrator.']);
            }
            else
            {
                $mining = DB::select(DB::raw("SELECT COALESCE(SUM(coins),0) as coins_mined FROM minings WHERE customer_id = '$customer->id' AND DATE_FORMAT(created_at,'%e %c %Y') = DATE_FORMAT(now(),'%e %c %Y')"));
                $misc = Misc::where('id','=',1)->first();

                return response()->json(['error' => false, 'misc' => $misc, 'user' => $customer, 'mined_today' => $mining[0]->coins_mined, 'success_msg' => 'Data fetched successfully']);
            }
        }
        else
        {
            return response()->json(['error' => true,'error_msg' => 'No User Found..!']);
        }
    }

    public function fb_social_login(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'device_id' => 'required',
            'facebook_id' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return response()->json(['error'=> true, 'error_msg' => $validator->errors()->first()]);
        }

        $customer = Customer::where('email','=',$request->email)->orWhere('facebook_id','=',$request->facebook_id)->first();

        if($customer)
        {
            if($customer->status == 0)
            {
                return response()->json(['error'=> true, 'error_msg' => 'You have been blocked please contact administrator.']);
            }
            else
            {
                $mining = DB::select(DB::raw("SELECT COALESCE(SUM(coins),0) as coins_mined FROM minings WHERE customer_id = '$customer->id' AND DATE_FORMAT(created_at,'%e %c %Y') = DATE_FORMAT(now(),'%e %c %Y')"));
                $misc = Misc::where('id','=',1)->first();
                
                $device_id = DeviceId::create([
                    'customer_id' => $customer->id,
                    'device_id' => $request->device_id
                ]);

                if($device_id)
                {
                    return response()->json(['error' => false, 'misc' => $misc, 'user' => $customer, 'mined_today' => $mining[0]->coins_mined, 'success_msg' => 'Logged In successfully']);
                }
                else
                {
                    return response()->json(['error' => true,'error_msg' => 'Unable to login please try again']);
                }
            }
        }
        else
        {
            $misc = Misc::where('id','=',1)->first();

            $customer = Customer::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'device_id' => $request->device_id,
                'facebook_id' => $request->facebook_id,
                'mining_rate' => $misc->default_mining_rate,
                'referal_code' => uniqid()
            ]);

            if($customer)
            {
                $mining = DB::select(DB::raw("SELECT COALESCE(SUM(coins),0) as coins_mined FROM minings WHERE customer_id = '$customer->id' AND DATE_FORMAT(created_at,'%e %c %Y') = DATE_FORMAT(now(),'%e %c %Y')"));
                
                $device_id = DeviceId::create([
                    'customer_id' => $customer->id,
                    'device_id' => $request->device_id
                ]);

                if($device_id)
                {
                    $get_customer = Customer::where('id','=',$customer->id)->first();
                    return response()->json(['error' => false, 'misc' => $misc, 'user' => $get_customer, 'mined_today' => $mining[0]->coins_mined, 'success_msg' => 'Logged In successfully']);
                }
                else
                {
                    return response()->json(['error' => true,'error_msg' => 'Unable to signup please try again']);
                }
            }
            else
            {
                return response()->json(['error'=> true, 'error_msg' => 'Unable signup. Please try again later..!']);
            }
        }
    }

    public function google_social_login(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'device_id' => 'required',
            'google_id' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return response()->json(['error'=> true, 'error_msg' => $validator->errors()->first()]);
        }

        $customer = Customer::where('email','=',$request->email)->orWhere('google_id','=',$request->google_id)->first();

        if($customer)
        {
            if($customer->status == 0)
            {
                return response()->json(['error'=> true, 'error_msg' => 'You have been blocked please contact administrator.']);
            }
            else
            {
                $mining = DB::select(DB::raw("SELECT COALESCE(SUM(coins),0) as coins_mined FROM minings WHERE customer_id = '$customer->id' AND DATE_FORMAT(created_at,'%e %c %Y') = DATE_FORMAT(now(),'%e %c %Y')"));
                $misc = Misc::where('id','=',1)->first();

                $device_id = DeviceId::create([
                    'customer_id' => $customer->id,
                    'device_id' => $request->device_id
                ]);

                if($device_id)
                {
                    return response()->json(['error' => false, 'misc' => $misc, 'user' => $customer, 'mined_today' => $mining[0]->coins_mined, 'success_msg' => 'Logged In successfully']);
                }
                else
                {
                    return response()->json(['error' => true,'error_msg' => 'Unable to login please try again']);
                }
            }
        }
        else
        {
            $misc = Misc::where('id','=',1)->first();

            $customer = Customer::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'device_id' => $request->device_id,
                'google_id' => $request->google_id,
                'mining_rate' => $misc->default_mining_rate,
                'referal_code' => uniqid()
            ]);

            if($customer)
            {
                $mining = DB::select(DB::raw("SELECT COALESCE(SUM(coins),0) as coins_mined FROM minings WHERE customer_id = '$customer->id' AND DATE_FORMAT(created_at,'%e %c %Y') = DATE_FORMAT(now(),'%e %c %Y')"));

                $device_id = DeviceId::create([
                    'customer_id' => $customer->id,
                    'device_id' => $request->device_id
                ]);

                if($device_id)
                {
                    $get_customer = Customer::where('id','=',$customer->id)->first();
                    return response()->json(['error' => false, 'misc' => $misc,'user' => $get_customer, 'mined_today' => $mining[0]->coins_mined, 'success_msg' => 'Logged In successfully']);
                }
                else
                {
                    return response()->json(['error' => true,'error_msg' => 'Unable to signup please try again']);
                }
            }
            else
            {
                return response()->json(['error'=> true, 'error_msg' => 'Unable signup. Please try again later..!']);
            }
        }
    }

    public function update_image(Request $request)
    {
        $rules = [
            'image' => 'required',
            'customer_id' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return response()->json(['error'=> true, 'error_msg' => $validator->errors()->first()]);
        }

        $customer = Customer::where('id','=',$request->customer_id)->first();

        $image_parts = explode(";base64,",$request->image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $imageName = uniqid() .'.'.$image_type;
        
        
        if($image_type == 'jpg' || $image_type == 'JPG' || $image_type == 'png' || $image_type == 'PNG' || $image_type == 'JPEG' || $image_type == 'jpeg')
        {
            file_put_contents(public_path('user_images/').$imageName, $image_base64);
            $customer->image = $imageName;
            $customer->save();

            return response()->json(['error' => false,'user' => $customer,'success_msg' => 'Profile picture updated successfully']);
        }
        else
        {
            return response()->json(['error'=> true, 'error_msg' => 'Please Upload a valid image']);
        }
    }

    public function customer_signup(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:customers',
            'password' => 'required',
            'device_id' => 'required',
            'wallet_address' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return response()->json(['error'=> true, 'error_msg' => $validator->errors()->first()]);
        }
        
        $misc = Misc::where('id','=',1)->first();

        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'device_id' => $request->device_id,
            'wallet_address' => $request->wallet_address,
            'mining_rate' => $misc->default_mining_rate,
            'referal_code' => uniqid()
        ]);

        if($request->referal_code != null || $request->referal_code != '')
        {
            $customer->invited_by = $request->referal_code;
            $customer->save();
            
            $invited_by = Customer::where('referal_code','=',$request->referal_code)->first();
            
            if($invited_by)
            {
                $invited_by->mining_rate = ($misc->referal_bonus/100)*$misc->default_mining_rate;
                $invited_by->save();
            }
            else
            {
                return response()->json(['error'=> true, 'error_msg' => "Unable to signup. Please Try again"]);
            }
        }

        if($customer)
        {
            $mining = DB::select(DB::raw("SELECT COALESCE(SUM(coins),0) as coins_mined FROM minings WHERE customer_id = '$customer->id' AND DATE_FORMAT(created_at,'%e %c %Y') = DATE_FORMAT(now(),'%e %c %Y')"));
            $misc = Misc::where('id','=',1)->first();

            $device_id = DeviceId::create([
                'customer_id' => $customer->id,
                'device_id' => $request->device_id
            ]);

            if($device_id)
            {
                $get_customer = Customer::where('id','=',$customer->id)->first();
                return response()->json(['error' => false, 'misc' => $misc, 'user' => $get_customer, 'mined_today' => $mining[0]->coins_mined, 'success_msg' => 'Logged In successfully']);
            }
            else
            {
                return response()->json(['error' => true,'error_msg' => 'Unable to login please try again']);
            }
        }
        else
        {
            return response()->json(['error'=> true, 'error_msg' => 'Unable signup. Please try again later..!']);
        }
    }

    public function customer_update_profile(Request $request)
    {
        $rules = [
            'customer_id' => 'required',
            'name' => 'required'
        ];
        
        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return response()->json(['error'=> true, 'error_msg' => $validator->errors()->first()]);
        }
        
        $customer = Customer::where('id','=',$request->customer_id)->first();
        
        if($customer)
        {
            if($customer->status == 0)
            {
                return response()->json(['error'=> true, 'error_msg' => 'You have been blocked please contact administrator.']);
            }
            else
            {
                $customer->name = $request->name;
                $customer->save();
                
                return response()->json(['error'=> false, 'user' => $customer, 'success_msg' => 'Profile updated successfully']);
            }
        }
        else
        {
            return response()->json(['error' => true,'error_msg' => 'No User Found..!']);
        }
    }
    
    public function customer_change_password(Request $request)
    {
        $rules = [
            'new_password' => 'required',
            'old_password' => 'required',
            'customer_id' => 'required'
        ];
        
        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return response()->json(['error'=> true, 'error_msg' => $validator->errors()->first()]);
        }
        
        $customer = Customer::where('id','=',$request->customer_id)->first();
        
        if(password_verify($request->old_password, $customer->password))
        {
            $customer->password = Hash::make($request->new_password);
            $customer->save();
            
            return response()->json(['error' => false,'user' => $customer,'success_msg' => 'Password updated successfully!']);
        }
        else
        {
            return response()->json(['error' => true,'error_msg' => 'Password incorrect..Please Try Again!']);
        }
    }
    
    public function customer_create_password(Request $request)
    {
        $rules = [
            'new_password' => 'required',
            'customer_id' => 'required'
        ];
        
        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return response()->json(['error'=> true, 'error_msg' => $validator->errors()->first()]);
        }
        
        $customer = Customer::where('id','=',$request->customer_id)->first();
        
        if($customer)
        {
            if($customer->status == 0)
            {
                return response()->json(['error'=> true, 'error_msg' => 'You have been blocked please contact administrator.']);
            }
            else
            {
                $customer->password = Hash::make($request->new_password);
                $customer->save();
                return response()->json(['error'=> false, 'success_msg' => 'Password created successfully']);
            }
        }
        else
        {
            return response()->json(['error' => true,'user' => $customer,'error_msg' => 'User not found..!']);
        }
    }
    
    public function customer_logout(Request $request)
    {
        $rules = [
            'device_id' => 'required',
            'customer_id' => 'required'
        ];
        
        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return response()->json(['error'=> true, 'error_msg' => $validator->errors()->first()]);
        }

        $customer = Customer::where('id','=',$request->customer_id)->first();
        
        if($customer)
        {
            if($customer->status == 0)
            {
                return response()->json(['error'=> true, 'error_msg' => 'You have been blocked please contact administrator.']);
            }
            else
            {
                $device_id = DeviceId::where('customer_id','=',$request->customer_id)->where('device_id','=',$request->device_id)->delete();

                if($device_id)
                {
                    return response()->json(['error'=> false, 'success_msg' => 'Logged out successfully']);
                }
                else
                {
                    return response()->json(['error'=> true, 'error_msg' => 'Unable to logout please try again']);
                }
            }
        }
        else
        {
            return response()->json(['error'=> true, 'error_msg' => 'User not found..!']);
        }
    }

    public function customer_forgot_password(Request $request)
    {
        $rules = [
            'code' => 'required',
            'email' => 'required'
        ];
        
        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return response()->json(['error'=> true, 'error_msg' => $validator->errors()->first()]);
        }

        $customer = Customer::where('email','=',$request->email)->first();

        if($customer)
        {
            if($customer->status == 0)
            {
                return response()->json(['error'=> true, 'error_msg' => 'You have been blocked please contact administrator.']);
            }
            else
            {
                $to = $customer->email;
                $from = 'no-reply@gelera.com';
                $subject = 'Password Recovery';
                $message = 'Your 6 digit code is '.$request->code.' If you have not request kindly change your credential and contact administrator.';
                $headers = 'From: no-reply@gelera.com'."\r\n".
                'Reply-To: no-reply@gelera.com'. "\r\n" .
                'X-Mailer: PHP/' . phpversion();
                mail($to, $subject, $message, $headers);
    
                return response()->json(['error'=> false, 'success_msg' => 'Mail sent successfully', 'user' => $customer->id]);
            }
        }
        else
        {
            return response()->json(['error'=> true, 'error_msg' => 'User not found']);
        }
    }

    public function create_wallet_address(Request $request)
    {
        $rules = [
            'wallet_address' => 'required',
            'customer_id' => 'required'
        ];
        
        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return response()->json(['error'=> true, 'error_msg' => $validator->errors()->first()]);
        }

        $customer = Customer::where('id','=',$request->customer_id)->first();

        if($customer)
        {
            if($customer->status == 0)
            {
                return response()->json(['error'=> true, 'error_msg' => 'You have been blocked please contact administrator.']);
            }
            else
            {
                $customer->wallet_address = $request->wallet_address;
                $customer->save();

                return response()->json(['error'=> false, 'success_msg' => 'Wallet address added successfully']);
            }
        }
        else
        {
            return response()->json(['error'=> true, 'error_msg' => 'User not found..!']);
        }
    }

    public function update_wallet_address(Request $request)
    {
        $rules = [
            'new_wallet_address' => 'required',
            'old_wallet_address' => 'required',
            'customer_id' => 'required'
        ];
        
        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return response()->json(['error'=> true, 'error_msg' => $validator->errors()->first()]);
        }

        $customer = Customer::where('id','=',$request->customer_id)->first();

        if($customer)
        {
            if($customer->status == 0)
            {
                return response()->json(['error'=> true, 'error_msg' => 'You have been blocked please contact administrator.']);
            }
            else
            {
                if($customer->wallet_address == $request->old_wallet_address)
                {
                    $customer->wallet_address = $request->new_wallet_address;
                    $customer->save();

                    return response()->json(['error'=> false, 'success_msg' => 'Wallet address added successfully']);
                }
                else
                {
                    return response()->json(['error'=> true, 'error_msg' => 'Old Wallet address not correct..!']);
                }
            }
        }
        else
        {
            return response()->json(['error'=> true, 'error_msg' => 'User not found..!']);
        }
    }

    public function customer_add_coins(Request $request)
    {
        $rules = [
            'coins' => 'required',
            'customer_id' => 'required'
        ];
        
        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return response()->json(['error'=> true, 'error_msg' => $validator->errors()->first()]);
        }

        $customer = Customer::where('id','=',$request->customer_id)->first();

        if($customer)
        {
            if($customer->status == 0)
            {
                return response()->json(['error'=> true, 'error_msg' => 'You have been blocked please contact administrator.']);
            }
            else
            {
                $new_coins_amount = $customer->total_coins+$request->coins;
                $customer->total_coins = $new_coins_amount;
                $customer->save();

                $mining = Mining::create([
                    'customer_id' => $request->customer_id,
                    'coins' => $request->coins
                ]);

                $mining = DB::select(DB::raw("SELECT COALESCE(SUM(coins),0) as coins_mined FROM minings WHERE customer_id = '$customer->id' AND DATE_FORMAT(created_at,'%e %c %Y') = DATE_FORMAT(now(),'%e %c %Y')"));
                $misc = Misc::where('id','=',1)->first();

                return response()->json(['error'=> false, 'user' => $customer, 'misc' => $misc , 'mined_today' => $mining[0]->coins_mined, 'success_msg' => 'Coins added to your wallet successfully']);
            
            }
        }
        else
        {
            return response()->json(['error'=> true, 'error_msg' => 'User not found..!']);
        }
    }
}