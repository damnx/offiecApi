<?php

namespace App\Policies;

use App\GroupUsers;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupUsersPolicy
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

    // phân quyền admin chên chính polices đấy
    // public function before(User $user)
    // {
    //     if($user->is_sadmin){
    //         return true;
    //     }
    // }

    public function view(User $user, GroupUsers $groupUsers)
    {
        return $groupUsers->creator_id === $user->id;
    }

    public function create()
    {
        return true;
    }

}
