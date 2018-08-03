<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupUser extends Model
{
    protected $table = 'group_users';

    protected $fillable = [
        'name', 'status'
    ];

    public function user()
    {
        return $this->hasMany('App\User', 'group_user_id', 'id');
    }
}
