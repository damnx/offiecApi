<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    use SoftDeletes;

    protected $primaryKey = 'id';
    public $incrementing = false;

    protected $fillable = [
        'id', 'name', 'email', 'password', 'address', 'gender', 'phone_number', 'is_active', 'is_sadmin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Roles', 'role_users', 'user_id', 'role_id');
    }

    // mối quan hệ users  với group users
    public function groupUser()
    {
        return $this->belongsTo('App\GroupUsers', 'group_user_id', 'id');
    }

    /**
     * Checks if User has access to $permissions.
     */
    public function hasAccess(string $permissions)
    {
      
        // check if the permission in $role
        foreach ($this->roles as $role) {
            if (array_search($permissions, $role->permissions)) {
                return true;
            }
        }
        return false;
    }

    public function registerUsers($request)
    {
        try {
            $user = User::create([
                'id' => uniqid(null, true),
                'email' => $request['email'],
                'name' => $request['full_name'],
                'password' => bcrypt($request['password']),
                'address' => $request['address'],
                'phone_number' => $request['phone_number'],
            ]);
            return $user;
        } catch (\Exception $e) {

            return null;
        }
    }

}
