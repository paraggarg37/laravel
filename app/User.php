<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */



    protected $with = ['shop','address'];

    protected $fillable = [
        'name', 'email', 'password', 'shop_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'shop_id', 'role', 'created_at', 'updated_at'
    ];

    public function shop()
    {
        return $this->hasOne('App\Shop', 'shop_id', 'shop_id');
    }

    public function address(){
        return $this->hasMany('App\Address');
    }
}
