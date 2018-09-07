<?php
namespace App\Acl;

use Illuminate\Support\Facades\Gate;

class DefinePolicies
{
    private static $abilities = [
        'post.update' => 'App\Policies\GroupUsersPolicy@create',
        // 'VIEW_GROUPUSERS' => 'App\Policies\GroupUsersPolicy@create',
    ];

    public static function defineAbilities()
    {
        foreach (self::$abilities as $key => $value) {
            Gate::define($key, $value);
        }
    }
}
