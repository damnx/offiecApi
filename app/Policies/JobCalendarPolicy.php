<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class JobCalendarPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function view(User $user)
    {
        return $user->hasAccess('VIEW_JOB_CALENDAR');
    }

    public function create(User $user)
    {
        return $user->hasAccess('CREATE_JOB_CALENDAR');
    }

    public function update(User $user)
    {
        return $user->hasAccess('UPDATE_JOB_CALENDAR');
    }

    public function destroy(User $user)
    {
        return $user->hasAccess('DELETE_JOB_CALENDAR');
    }
}
