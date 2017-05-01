<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;




    protected $dates = ['deleted_at'];
    protected $primaryKey = 'id';
    protected $table = 'address';
    protected $hidden = array('created_at', 'updated_at','deleted_at');
}
