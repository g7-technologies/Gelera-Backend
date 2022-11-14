<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable = ['id','question','answer','created_at','updated_at'];
}