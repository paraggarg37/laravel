<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $hidden = array('created_at', 'updated_at','deleted_at');
    protected $table = 'category';
    protected $primaryKey = 'category_id';
    protected $guarded = [];

    //protected $with=['products'];

    public function products(){
        return $this->hasMany('App\Product','product_category_id','category_id');
    }

    protected $dates = ['deleted_at'];
}
