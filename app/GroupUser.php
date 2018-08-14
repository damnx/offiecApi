<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GroupUser extends Model
{
    protected $table = 'group_users';
    protected $fillable = [
        'name', 'status',
    ];

    public function user()
    {
        return $this->hasMany('App\User', 'group_user_id', 'id');
    }

    public function saturdayFulls()
    {
        return $this->hasMany('App\SaturdayFulls', 'id_group_users', 'id');
    }

    public function calendars()
    {
        return $this->belongsToMany('App\Calendars', 'calendar_work_group_user','group_user_id', 'calendars_id');
    }

}
