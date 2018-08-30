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

    public function createOrUpdateJobCalendarGroupUses($groupUserId, $jobCalendarId, $request)
    {
        // create or update
        try {
            $jobCalendarGroupUses = jobCalendarGroupUses::firstOrNew(['group_user_id' => $groupUserId, 'job_calendar_id' => $jobCalendarId]);
            if (!$jobCalendarGroupUses->exists) {
                // create
                $jobCalendarGroupUses->id = uniqid(null, true);
                $jobCalendarGroupUses->coefficient = $request['coefficient'];
                $jobCalendarGroupUses->start = $request['start'];
                $jobCalendarGroupUses->end = $request['end'];
                $jobCalendarGroupUses->save();
            } else {
                // update
                $jobCalendarGroupUses->coefficient = $request['coefficient'];
                $jobCalendarGroupUses->start = $request['start'];
                $jobCalendarGroupUses->end = $request['end'];
                $jobCalendarGroupUses->save();
            }

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

    public function deleteJobCalendarGroupUses($groupUserId, $jobCalendarId)
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
