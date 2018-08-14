<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calendars extends Model
{
    protected $table = 'calendars';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['day', 'date', 'start', 'end'];

    public function groupUser()
    {
        return $this->belongsToMany('App\GroupUser', 'calendar_work_group_user','calendars_id', 'group_user_id');
    }
}
