<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    protected $fillable = ['id','name','email','password','token','image','wallet_address','facebook_id','mining_rate','referal_code','total_coins','invited_by','notification_number','status','created_at','updated_at'];
    protected $hidden = ['password','token'];

    
}