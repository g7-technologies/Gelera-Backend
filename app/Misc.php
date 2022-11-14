<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Misc extends Model
{
    protected $fillable = ['id','daily_limit','referal_bonus','default_mining_rate','coin_price','created_at','updated_at'];

    

    // public function customer_info()
    // {
    //     return $this->belongsTo('\App\Customer','customer_id');
    // }

    // public function coin_info()
    // {
    //     return $this->belongsTo('\App\Coin','coin_id');
    // }
}