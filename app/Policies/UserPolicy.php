<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        // check if the 2 users has the same id
        return ($user->is_admin || $user->is($model));
    }

}
