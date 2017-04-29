<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    //




    protected $hidden = array('created_at', 'updated_at','deleted_at');
    protected $table = 'shop';
    protected $primaryKey = 'shop_id';
    protected $guarded = [];
    protected $with = ['products','products.category','products.images'];


    public function products()
    {
        return $this->hasMany('App\Product','product_shop_id','shop_id');
    }
}
