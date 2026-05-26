<?php

namespace App\Policies;

use App\Models\User;
use App\UserRole;

class UserPolicy
{

    public function __construct()
    {
    }

    public function before(User $authUser) {

        if ($authUser->role === UserRole::ADMIN) return true;
    }

    public function update (User $authUser, User $user) : bool {

        return $authUser->id === $user->id;
    }

    public function delete (User $authUser, User $user) : bool {

        return $authUser->id === $user->id;
    }
}
