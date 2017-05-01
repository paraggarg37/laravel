<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    //

    use SoftDeletes;
    protected $dates = ['deleted_at'];


    protected $hidden = array('created_at', 'updated_at','deleted_at');
    protected $table = 'product';
    protected $primaryKey = 'product_id';
    protected $guarded = [];
    protected $with = ['category','images'];

    public function category()
    {
        return $this->hasOne('App\Category','category_id','product_category_id');
    }

    public function images()
    {
        return $this->morphMany('App\Images', 'reference');
    }
}
