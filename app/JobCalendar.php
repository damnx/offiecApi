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
        $jobCalendar = JobCalendar::find($id);
        return $jobCalendar;
    }

    public function updateJobCalendarGroupUses($request, $id)
    {
        try {
            DB::beginTransaction();
            $jobCalendar = JobCalendar::find($id);
            if (!$jobCalendar) {
                return response()->json([
                    'message' => 'Update error',
                    'status' => 1,
                    'error' => [],
                    'data' => [],
                ]);
            }

            $jobCalendar->date = $request['date'];
            $jobCalendar->day = $request['day'];
            $jobCalendar->description = isset($request['description']) ? $request['description'] : null;
            $jobCalendar->save();

            $checkRemove = false;
            $checkUpdate = false;

            $groupUserIdRemove = isset($request['group_user_id_remove']) ? $request['group_user_id_remove'] : [];
            if (!$groupUserIdRemove) {
                $checkRemove = true;
            } else {
                foreach ($groupUserIdRemove as $key => $value) {
                    $removeIteam[$key] = JobCalendarGroupUses::where('group_user_id', $value)
                        ->where('job_calendar_id', $jobCalendar->id)->delete();
                    if ($removeIteam[$key]) {
                        $checkRemove = true;
                    } else {
                        $checkRemove = false;
                    }
                }
            }

            $groupUserId = isset($request['group_user_id']) ? $request['group_user_id'] : [];
            foreach ($groupUserId as $key => $value) {
                $iteam[$key] = JobCalendarGroupUses::where('group_user_id', $value)->where('job_calendar_id', $jobCalendar->id)->first();
                if ($iteam[$key]) {
                    $iteam[$key]->coefficient = $request['coefficient'];
                    $iteam[$key]->start = $request['start'];
                    $iteam[$key]->end = $request['end'];
                    $iteam[$key]->save();
                    $checkUpdate = true;
                } else {
                    $iteam[$key] = JobCalendarGroupUses::create([
                        'id' => uniqid(null, true),
                        'group_user_id' => $value,
                        'job_calendar_id' => $jobCalendar->id,
                        'coefficient' => $request['coefficient'],
                        'start' => $request['start'],
                        'end' => $request['end'],
                    ]);
                    if ($iteam[$key]) {
                        $checkUpdate = true;
                    } else {
                        $checkUpdate = false;
                    }
                }
            }

            if (!$checkRemove || !$checkUpdate) {
                return response()->json([
                    'message' => 'Update error',
                    'status' => 1,
                    'error' => [],
                    'data' => [],
                ]);
            }

            DB::commit();
            return response()->json([
                'message' => 'Update success',
                'status' => 0,
                'error' => [],
                'data' => ['jobCalendar' => $jobCalendar, 'jobCalendarGroupUsers' => $iteam],
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            // return $e->getMessage();
            return response()->json([
                'message' => 'Update error',
                'status' => 1,
                'error' => [],
                'data' => [],
            ]);
        }

    }

    public function createJobCalendarGroupUses($request)
    {
        try {
            DB::beginTransaction();
            $jobCalendar = JobCalendar::create([
                'id' => uniqid(null, true),
                'date' => $request['date'],
                'day' => $request['day'],
                'description' => isset($request['description']) ? $request['description'] : null,
            ]);

            if (!$jobCalendar) {
                return response()->json([
                    'message' => 'Create error',
                    'status' => 1,
                    'error' => [],
                    'data' => [],
                ]);
            }

            $groupUserId = $request['group_user_id'];
            $check = false;
            $iteam = [];
            foreach ($groupUserId as $key => $value) {
                $iteam[$key] = JobCalendarGroupUses::create([
                    'id' => uniqid(null, true),
                    'group_user_id' => $value,
                    'job_calendar_id' => $jobCalendar->id,
                    'coefficient' => $request['coefficient'],
                    'start' => $request['start'],
                    'end' => $request['end'],
                ]);
                if ($iteam[$key]) {
                    $check = true;
                }

            }

            if (!$check) {
                return response()->json([
                    'message' => 'Create error',
                    'status' => 1,
                    'error' => [],
                    'data' => [],
                ]);
            }

            DB::commit();
            return response()->json([
                'message' => 'Create success',
                'status' => 0,
                'error' => [],
                'data' => ['jobCalendar' => $jobCalendar->toArray(), 'jobCalendarGroupUsers' => $iteam],
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            // return $e->getMessage();
            return response()->json([
                'message' => 'Create error',
                'status' => 1,
                'error' => [],
                'data' => [],
            ]);
        }

    }

    public function destroyJobCalendar($id)
    {
        try {

            $jobCalendar = JobCalendar::find($id);
            if (!$jobCalendar) {
                return response()->json([
                    'message' => 'Delete error',
                    'status' => 1,
                    'error' => [],
                    'data' => [],
                ]);
            }
            return response()->json([
                'message' => 'Delete success',
                'status' => 0,
                'error' => [],
                'data' => $jobCalendar,
            ]);

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

}
