<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    //
    protected $fillable = [
        'avatar',
        'birthday',
        'gender_id',
        'status_id',
        'user_id'
    ];
}
