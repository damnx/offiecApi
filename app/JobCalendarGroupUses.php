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
        'id', 'coefficient', 'start', 'end', 'job_calendar_id', 'group_user_id',
    ];

    public function createJobCalendarGroupUses($value, $jobCalendarId, $request)
    {
        try {
            $jobCalendarGroupUsess = JobCalendarGroupUses::firstOrCreate(['group_user_id'=>$value,'job_calendar_id'=>$jobCalendarId]);
            var_dump( $jobCalendarGroupUsess->toArray());
            $jobCalendarGroupUses = JobCalendarGroupUses::create([
                'id' => uniqid(null, true),
                'group_user_id' => $value,
                'job_calendar_id' => $jobCalendarId,
                'coefficient' => $request['coefficient'],
                'start' => $request['start'],
                'end' => $request['end'],
            ]);

            return $jobCalendarGroupUses;
        } catch (\Exception $e) {
            // return $e->getMessage();
            return null;
        }

    }

    public function firstJobCalendarGroupUses($groupUserId, $jobCalendarId)
    {
        try {
            $data = JobCalendarGroupUses::where('group_user_id', $groupUserId)->where('job_calendar_id', $jobCalendarId)->first();
            return $data;
        } catch (\Exception $e) {
            // return $e->getMessage();
            return null;
        }

    }

    public function updateJobCalendarGroupUses($groupUserId, $jobCalendarId, $request)
    {
        try {
            $iteam = $this->firstJobCalendarGroupUses($groupUserId, $jobCalendarId);
            if (!$iteam) {
                return null;
            }

            $iteam->coefficient = $request['coefficient'];
            $iteam->start = $request['start'];
            $iteam->end = $request['end'];
            $iteam->save();
            return $iteam;

        } catch (\Exception $e) {
            // return $e->getMessage();
            return null;
        }

    }

    public function deleteCalendarGroupUses($groupUserId, $jobCalendarId)
    {
        try {
            $jobCalendarGroupUses = $this->firstJobCalendarGroupUses($groupUserId, $jobCalendarId);
            if (!$jobCalendarGroupUses) {
                return null;
            }
            $jobCalendarGroupUses->delete();
            return $jobCalendarGroupUses;
        } catch (\Exception $e) {
            // return $e->getMessage();
            return null;
        }

    }
}
