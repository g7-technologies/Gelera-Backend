<?php

use Illuminate\Http\Request;

Route::post('/customer_login','API\CustomerController@customer_login');

Route::post('/dashboard_data','API\CustomerController@Dashboard_data');

Route::post('/fb_social_login','API\CustomerController@fb_social_login');

Route::post('/google_social_login','API\CustomerController@google_social_login');

Route::post('/update_image','API\CustomerController@update_image');

Route::post('/customer_signup','API\CustomerController@customer_signup');

Route::post('/customer_update_profile','API\CustomerController@customer_update_profile');

Route::post('/customer_change_password','API\CustomerController@customer_change_password');

Route::post('/customer_create_password','API\CustomerController@customer_create_password');

Route::post('/customer_logout','API\CustomerController@customer_logout');

Route::post('/customer_forgot_password','API\CustomerController@customer_forgot_password');

Route::post('/create_wallet_address','API\CustomerController@create_wallet_address');

Route::post('/update_wallet_address','API\CustomerController@update_wallet_address');

Route::post('/customer_add_coins','API\CustomerController@customer_add_coins');