<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['id','name','category_id','description','price','profit','min','max','status','created_at','updated_at'];

    public function category_info()
    {
        return $this->belongsTo('\App\Category','category_id');
    }
}