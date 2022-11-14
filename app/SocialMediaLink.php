<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class SocialMediaLink extends Model
{
    protected $fillable = ['id','twitter','facebook','linkedin','instagram','discord','google','youtube','vimeo','pinterest','created_at', 'updated_at'];
}