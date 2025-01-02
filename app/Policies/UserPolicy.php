<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function modify(User $user, User $model): bool
    {
        if (!$user->is_admin && $user->id !== $model->id) {
            return false;
        }

        return true;
    }
}
