<?php

Route::get('/test','AdminController@test');

//---------------------------------------Admin Auth Routes------------------------------------------

Route::get('/','AdminController@login');
Route::get('/terms_of_service','AdminController@terms_of_service');
Route::get('/privacy_policy','AdminController@privacy_policy');
Route::get('/faqs','AdminController@faqs');
Route::get('/login','AdminController@login');
Route::post('/login_submit','AdminController@login_submit');
Route::get('/forgot_password','AdminController@forgot_password');
Route::post('/forgot_password_submit','AdminController@forgot_password_submit');
Route::get('/reset_password/{token}','AdminController@reset_password');
Route::post('/reset_password_submit','AdminController@reset_password_submit');

Route::group(['middleware' => ['auth:admin','backHistory']], function()
{
    //----------admin logout----------------------
    Route::get('/logout','AdminController@logout');

    //----------admin Dashboard--------------------
    Route::get('/dashboard','AdminController@dashboard');
    Route::post('/chart_mining','AdminController@chart_mining')->name('chart_mining');
    
    //----------admin Profile-----------------------
    Route::get('/change_password','AdminController@change_password');
    Route::post('/change_password_submit','AdminController@change_password_submit');

    //----------Admin Users routes-------------------
    Route::get('/all_users','AdminController@all_users');
    Route::get('/active_users','AdminController@active_users');
    Route::get('/blocked_users','AdminController@blocked_users');
    Route::get('/disable_user/{id}','AdminController@disable_user');
    Route::get('/activate_user/{id}','AdminController@activate_user');

    //----------Admin Notification routes-------------------
    Route::get('/send_notification','AdminController@send_notification');
    Route::post('/send_notification_submit','AdminController@send_notification_submit');

    //----------Admin Extras routes-------------------
    Route::get('/daily_coins_limit','AdminController@daily_coins_limit');
    Route::get('/referal_bonus','AdminController@referal_bonus');
    Route::get('/coins_per_click','AdminController@coins_per_click');

    Route::post('/daily_coins_limit_submit','AdminController@daily_coins_limit_submit');
    Route::post('/referal_bonus_submit','AdminController@referal_bonus_submit');
    Route::post('/coins_per_click_submit','AdminController@coins_per_click_submit');

    Route::get('/coin_price','AdminController@coin_price');
    Route::post('/coin_price_submit','AdminController@coin_price_submit');

    //----------Admin Social Media routes-------------------
    Route::get('/social_media_links','AdminController@social_media_links');
    Route::post('/social_media_links_submit','AdminController@social_media_links_submit');

    //----------Admin Faqs routes----------------------------
    Route::get('/view_faqs','AdminController@view_faqs');
    Route::get('/edit_faq/{id}','AdminController@edit_faq');
    Route::get('/delete_faq/{id}','AdminController@delete_faq');
    Route::post('/update_faq','AdminController@update_faq');
    Route::get('/add_faq','AdminController@add_faq');
    Route::post('/submit_add_faq','AdminController@submit_add_faq');
});	

