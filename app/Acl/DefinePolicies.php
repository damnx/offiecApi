<?php
namespace App\Acl;

use Illuminate\Support\Facades\Gate;

class DefinePolicies
{
    private static $abilities = [
        'CREATE_GROUP_USERS' => 'App\Policies\GroupUsersPolicy@create',
        'VIEW_GROUP_USERS' => 'App\Policies\GroupUsersPolicy@view',
    ];

    public static function defineAbilities()
    {
        foreach (self::$abilities as $key => $value) {
            Gate::define($key, $value);
        }
    }
}
