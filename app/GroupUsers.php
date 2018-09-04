<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GroupUsers extends Model
{
    //
    use SoftDeletes;
    // SoftDeletes xóa mền trong database
    protected $table = 'group_users';

    protected $primaryKey = 'id';
    public $incrementing = false;

    protected $fillable = [
        'id', 'name', 'description', 'status',
    ];

    // mối quan hệ group users  với users 1- > n
    public function users()
    {
        return $this->hasMany('App\User', 'group_user_id', 'id');
    }

    public function jobCalendar()
    {
        return $this->belongsToMany('App\JobCalendar', 'job_calendar_group_user', 'group_user_id', 'job_calendar_id')->withPivot('coefficient', 'start','end');
    }

    public function getFind($id)
    {
        try {
            $groupUsers = GroupUsers::find($id);
            return $groupUsers;
        } catch (\Exception $e) {
            return null;
        }

    }

    public function detailsGroupUsers($id)
    {
        try {
            $detailsGroupUsers = GroupUsers::with('users')
                ->where('id', $id)
                ->where('status', 'public')
                ->first();
            return $detailsGroupUsers;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function listGroupUsers($whereData)
    {
        try {
            $listGroupUsers = GroupUsers::with('users')
                ->where($whereData)
                ->orderBy('created_at', 'desc')
                ->paginate(20);
            return $listGroupUsers;

        } catch (\Exception $e) {
            return null;
        }
    }

    public function createGroupUsers($request)
    {
        try {
            $groupUsers = GroupUsers::create([
                'id' => uniqid(null, true),
                'name' => $request['name'],
                'status' => $request['status'],
                'description' => isset($request['description']) ? $request['description'] : null,
            ]);
            return $groupUsers;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function updateGroupUsers($request, $id)
    {
        try {
            $data = $this->getFind($id);
            if (!$data) {
                return null;
            }
            $data->name = $request['name'];
            $data->status = $request['status'];
            $data->description = isset($request['description']) ? $request['description'] : null;
            $data->save();
            return $data;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function destroyGroupUsers($id)
    {
        try {
            $groupUsers = GroupUsers::destroy($id);
            return $groupUsers;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function restoreGroupUsers($id)
    {
        try {
            $withTrashedGroupUsers = GroupUsers::withTrashed()
                ->where('id', $id)
                ->restore();
            return $withTrashedGroupUsers;
        } catch (\Exception $e) {
            return null;
        }

    }
}
