<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{

    use SoftDeletes;
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $table = 'cart';
}
