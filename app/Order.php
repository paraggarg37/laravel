<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $table = 'orders';
}
