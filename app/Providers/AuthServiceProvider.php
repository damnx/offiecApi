<?php

namespace App\Providers;

use App\Acl\DefinePolicies;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\GroupUsers' => 'App\Policies\GroupUsersPolicy',
        'App\JobCalendar' => 'App\Policies\JobCalendarPolicy',
        'App\Roles' => 'App\Policies\RolesPolicy',
        'App\Task' => 'App\Policies\TaskPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::before(function ($user) {
            if ($user->is_sadmin) {
                return true;
            }
        });

        DefinePolicies::defineAbilities();

        Passport::routes();

    }
}
