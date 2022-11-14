<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Mining extends Model
{
    protected $fillable = ['id','customer_id','coins','created_at','updated_at'];
}