<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shop extends Model
{
    //


    use SoftDeletes;
    protected $dates = ['deleted_at'];


    protected $hidden = array('created_at', 'updated_at', 'deleted_at');
    protected $table = 'shop';
    protected $primaryKey = 'shop_id';
    protected $guarded = [];
    protected $with = ['category', 'category.products', 'delivery_locations'];


    public function delivery_locations()
    {
        return $this->hasMany('App\ShopDeliveryLocations', 'shop_id', 'shop_id');
    }

    public function products()
    {
        return $this->hasMany('App\Product', 'product_shop_id', 'shop_id');
    }

    public function category()
    {
        return $this->hasMany('App\Category', 'category_shop_id', 'shop_id');
    }


}
