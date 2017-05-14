<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopDeliveryLocations extends Model
{


    public function address()
    {
        return $this->hasOne('App\Address', 'id', 'address_id');
    }

    protected $with = ['address'];
    protected $primaryKey = 'id';
    protected $table = 'shop_delivery_locations';
}
