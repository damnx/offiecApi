<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Roles extends Model
{
    //
    use SoftDeletes;
    protected $table = 'roles';

    protected $primaryKey = 'id';
    public $incrementing = false;

    protected $fillable = [
        'id', 'name', 'permissions', 'description', 'creator_id',
    ];

    protected $casts = [
        'permissions' => 'array',
    ];

    public function users()
    {
        return $this->belongsToMany('App\User', 'role_users', 'role_id', 'user_id');
    }

    public function createRoles($request)
    {
        try {
            DB::beginTransaction();
            $idUser = Auth::id();
            $groupUsers = Roles::create([
                'id' => uniqid(null, true),
                'name' => $request['name'],
                'description' => isset($request['description']) ? $request['description'] : null,
                'creator_id' => $idUser,
                'permissions' => isset($request['permissions']) ? $request['permissions'] : null,
            ]);
            if (!$groupUsers) {
                return null;
            }
            $groupUsers->users()->sync($request['userId']);
            DB::commit();
            return $groupUsers;
        } catch (\Exception $e) {
            DB::rollBack();
            return null;
        }
    }
}
