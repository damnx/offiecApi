<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobCalendarGroupUses extends Model
{
    //
    protected $table = 'job_calendar_group_user';
    protected $fillable = [
         'coefficient', 'start','end','job_calendar_id','group_user_id'
    ];

}
