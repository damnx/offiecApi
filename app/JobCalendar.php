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
    protected $fillable = [
        'date', 'day', 'description',
    ];

    public function groupUsers()
    {
        return $this->belongsToMany('App\GroupUsers', 'job_calendar_group_user', 'job_calendar_id', 'group_user_id');
    }

    public static function createJobCalendarGroupUses($request)
    {
        try {
            DB::beginTransaction();
            $jobCalendar = JobCalendar::create([
                'date' => $request['date'],
                'day' => $request['day'],
                'description' => isset($request['er']) ? $request['er'] : null,
            ]);

            if ($jobCalendar) {
                $groupUserId = $request['group_user_id'];
                $dataCreateJobCalendarGroupUsers = [];
                $check = false;
                $iteam = [];
                foreach ($groupUserId as $key => $value) {
                    $iteam[$key] = jobCalendarGroupUses::create([
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

                if ($check) {
                    DB::commit();
                    $data = [
                        'status' => 0,
                        'error' => [],
                        'data' => ['jobCalendar' => $jobCalendar->toArray(), 'jobCalendarGroupUsers' => $iteam],
                    ];
                    return $data;
                }
            }
        } catch (\Exception $e) {
            DB::rollBack();
            $data = [
                'status' => 1,
                'error' => ['error' => 'Create error'],
                'data' => [],
            ];
            return $data;
            // return $e->getMessage();
        }

    }

    public static function updateJobCalendarGroupUses($request)
    {
        
    }
}
