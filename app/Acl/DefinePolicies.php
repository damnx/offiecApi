<?php
namespace App\Acl;

use Illuminate\Support\Facades\Gate;

class DefinePolicies
{
    private static $abilities = [
        'CREATE_GROUP_USERS' => 'App\Policies\GroupUsersPolicy@create',
        'VIEW_GROUP_USERS' => 'App\Policies\GroupUsersPolicy@view',
        'UPDATE_GROUP_USERS' => 'App\Policies\GroupUsersPolicy@update',
        'DELETE_GROUP_USERS' => 'App\Policies\GroupUsersPolicy@destroy',
        // Job Calendar
        'CREATE_JOB_CALENDAR' => 'App\Policies\JobCalendarPolicy@create',
        'UPDATE_JOB_CALENDAR' => 'App\Policies\JobCalendarPolicy@update',
        'VIEW_JOB_CALENDAR' => 'App\Policies\JobCalendarPolicy@view',
        'DELETE_JOB_CALENDAR' => 'App\Policies\JobCalendarPolicy@destroy',
        //Roles
        'CREATE_ROLES' => 'App\Policies\RolesPolicy@create',
        'UPDATE_ROLES' => 'App\Policies\RolesPolicy@update',
        'VIEW_ROLES' => 'App\Policies\RolesPolicy@view',
        'DELETE_ROLES' => 'App\Policies\RolesPolicy@destroy',
    ];

    public static function defineAbilities()
    {
        foreach (self::$abilities as $key => $value) {
            Gate::define($key, $value);
        }
    }
}
