<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TimesheetPolicy extends BasePolicy
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

    public function viewAny(User $user): bool
    {
        return $user->isManager() || $user->isAdmin();
    }
 
    public function view(User $user, $model): bool
    {
        return $user->isManager() || $user->isAdmin();
    }
 
    public function update(User $user, $model): bool
    {
        return $user->isManager() || $user->isAdmin();
    }
 
    public function restore(User $user, $model): bool
    {
        return $user->isManager() || $user->isAdmin();
    }

}
