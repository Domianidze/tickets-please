<?php

namespace App\Policies;

use App\Models\Ticket;
use App\Models\User;

class TicketPolicy
{
    public function modify(User $user, Ticket $model): bool
    {
        if (!$user->is_admin && $user->id !== $model->user_id) {
            return false;
        }

        return true;
    }
}
