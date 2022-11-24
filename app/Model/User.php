<?php

namespace App\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';

    protected $fillable = [
        'account',
        'password',
        'remember_token',
    ];

    public $timestamps = false;

    /**
     * 一對一關聯待辦事項模型
     *
     * @return void
     */
    public function doList()
    {
        return $this->hasOne('App\Model\doList', 'user_id', 'id');
    }
}
