<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\URL;
class Images extends Model
{
    //

    use SoftDeletes;
    protected $dates = ['deleted_at'];


    /**
     * Get all of the owning commentable models.
     */
    public function type()
    {
        return $this->morphTo();
    }

    public function getImageAttribute()
    {

        return URL::to('/api/image/' . $this->attributes['id']);

    }


    protected $hidden = array('created_at', 'updated_at','deleted_at','reference_type','image_alt','rank');
    protected $table = 'images';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
