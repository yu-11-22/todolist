<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DoList extends Model
{
    protected $table = 'dolists';

    protected $fillable = [
        'user_id',
        'task',
        'description',
        'operate_at',
        'complete_at',
        'deleted_at',
        'status',
    ];

    public $timestamps = false;
}
