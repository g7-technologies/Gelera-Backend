<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class DeviceId extends Model
{
    protected $fillable = ['id','customer_id','device_id','created_at','updated_at'];
}
