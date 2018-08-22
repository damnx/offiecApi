<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupUsers extends Model
{
    //
    use SoftDeletes;
    // SoftDeletes xóa mền trong database
    protected $table = 'group_users';
    protected $fillable = [
         'name', 'description','status'
    ];

    // mối quan hệ group users  với users 1- > n
    public function users()
    {
        return $this->hasMany('App\User','group_user_id','id');
    }
}
