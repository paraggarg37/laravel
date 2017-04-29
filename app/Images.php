<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    //


    /**
     * Get all of the owning commentable models.
     */
    public function type()
    {
        return $this->morphTo();
    }


    protected $hidden = array('created_at', 'updated_at','deleted_at','reference_id','reference_type','image_alt','rank');
    protected $table = 'images';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
