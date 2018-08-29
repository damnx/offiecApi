<?php

namespace App;

use App\JobCalendarGroupUses;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class JobCalendar extends Model
{

    use SoftDeletes;
    protected $table = 'job_calendar';
    protected $primaryKey = 'id';
    public $incrementing = false;

    protected $fillable = [
        'id', 'date', 'day', 'description',
    ];

    public function groupUsers()
    {
        return $this->belongsToMany('App\GroupUsers', 'job_calendar_group_user', 'job_calendar_id', 'group_user_id');
    }

    public function getFindJobCalendar($id)
    {
        try {
            $jobCalendar = JobCalendar::find($id);
            return $jobCalendar;
        } catch (\Exception $e) {
            return null;
        }

    }

    // create jobCalendar
    public function createJobCalendar($request)
    {
        try {
            $jobCalendar = JobCalendar::create([
                'id' => uniqid(null, true),
                'date' => $request['date'],
                'day' => $request['day'],
                'description' => isset($request['description']) ? $request['description'] : null,
            ]);
            return $jobCalendar;

        } catch (\Exception $e) {
            return null;
        }

    }

    public function updateJobCalendar($id, $request)
    {
        $jobCalendar = $this->getFindJobCalendar($id);
        if (!$jobCalendar) {
            return null;
        }

        $jobCalendar->date = $request['date'];
        $jobCalendar->day = $request['day'];
        $jobCalendar->description = isset($request['description']) ? $request['description'] : null;
        $jobCalendar->save();

        return $jobCalendar;
    }

    public function updateJobCalendars($request, $id)
    {
        try {
            // DB::beginTransaction();
            $jobCalendarGroupUses = new JobCalendarGroupUses();
            $jobCalendar = $this->updateJobCalendar($id, $request);
            if (!$jobCalendar) {
                return null;
            }

            $checkRemove = false;
            $checkUpdate = false;

            $groupUserIdRemove = isset($request['group_user_id_remove']) ? $request['group_user_id_remove'] : [];
            if (!$groupUserIdRemove) {
                $checkRemove = true;
            } else {
                foreach ($groupUserIdRemove as $key => $value) {
                    $removeIteam[$key] = $jobCalendarGroupUses->deleteCalendarGroupUses($value, $jobCalendar->id);
                    if ($removeIteam[$key]) {
                        $checkRemove = true;
                    } else {
                        $checkRemove = false;
                    }
                }
            }

            $groupUserId = isset($request['group_user_id']) ? $request['group_user_id'] : [];
            foreach ($groupUserId as $key => $value) {
                $iteam[$key] = $jobCalendarGroupUses->updateJobCalendarGroupUses($value, $jobCalendar->id, $request);
                if ($iteam[$key]) {
                    $checkUpdate = true;
                } else {
                    $iteam[$key] = $jobCalendarGroupUses->createJobCalendarGroupUses($value, $jobCalendar->id, $request);
                    if ($iteam[$key]) {
                        $checkUpdate = true;
                    } else {
                        $checkUpdate = false;
                    }
                }
            }

            if (!$checkRemove || !$checkUpdate) {
                return null;
            }

            // DB::commit();
            return ['jobCalendar' => $jobCalendar, 'jobCalendarGroupUsers' => $iteam];

        } catch (\Exception $e) {
            // DB::rollBack();
            return $e->getMessage();

        }

    }

    public function createJobCalendarGroupUses($request)
    {
        try {
            DB::beginTransaction();
            $jobCalendar = $this->createJobCalendar($request);
            if ($jobCalendar) {
                return null;
            }
            $groupUserId = $request['group_user_id'];
            $check = false;
            $iteam = [];
            $jobCalendarGroupUses = new JobCalendarGroupUses();
            foreach ($groupUserId as $key => $value) {
                $iteam[$key] = $jobCalendarGroupUses->createJobCalendarGroupUses($value, $jobCalendar->id, $request);
                if ($iteam[$key]) {
                    $check = true;
                }
            }

            if (!$check) {
                return null;
            }

            DB::commit();
            return ['jobCalendar' => $jobCalendar->toArray(), 'jobCalendarGroupUsers' => $iteam];

        } catch (\Exception $e) {
            DB::rollBack();
            return null;
        }

    }

    public function destroyJobCalendar($id)
    {
        try {
            $jobCalendar = JobCalendar::destroy($id);
            if (!$jobCalendar) {
                return null;
            }
            return $jobCalendar;
        } catch (\Exception $e) {
            // return $e->getMessage();
            return null;
        }
    }

    public function returnMessageError($message = null)
    {
        return response()->json([
            'message' => isset($message) ? $message : 'error',
            'status' => 1,
            'error' => [],
            'data' => [],
        ]);
    }

    public function returnMessagesuccess($message = null, $data)
    {
        return response()->json([
            'message' => isset($message) ? $message : 'Success',
            'status' => 0,
            'error' => [],
            'data' => $data,
        ]);
    }

}
