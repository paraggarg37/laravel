<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $hidden = array('created_at', 'updated_at','deleted_at');
    protected $table = 'category';
    protected $primaryKey = 'category_id';
    protected $guarded = [];

    /*protected $with=['products'];

    public function products(){
        return $this->belongsTo('App\Product','category_id','product_category_id');
    }*/
}
