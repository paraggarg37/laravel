<?php

namespace App;
use App\Images;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\URL;

class Category extends Model
{
    use SoftDeletes;

    protected $hidden = array('created_at', 'updated_at', 'deleted_at');
    protected $table = 'category';
    protected $primaryKey = 'category_id';
    protected $guarded = [];

    protected $with = ['images'];

    public function products()
    {

        return $this->hasMany('App\Product', 'product_category_id', 'category_id');
    }

    public function images()
    {
        return $this->morphMany('App\Images', 'reference');
    }


    /*public function getCategoryImageAttribute()
    {

        return URL::to('/api/category/image/' . $this->attributes['category_id']);

    }*/

    protected $dates = ['deleted_at'];
}
