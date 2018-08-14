<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CalendarWorkGroupUser extends Model
{
    protected $table = 'calendars';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['calendars_id', 'group_user_id'];
}
