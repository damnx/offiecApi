<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobCalendarGroupUses extends Model
{
    //
    protected $table = 'job_calendar_group_user';
    
    protected $primaryKey = 'id';
    public $incrementing = false;

    protected $fillable = [
         'id','coefficient', 'start','end','job_calendar_id','group_user_id'
    ];
    

}
