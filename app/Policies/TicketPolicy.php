<?php

namespace App\Policies;

use App\Models\Ticket;
use App\Models\User;

class TicketPolicy
{
    public function modify(User $user, Ticket $ticket): bool
    {
        if (!$user->is_admin && $user->id !== $ticket->user_id) {
            return false;
        }

        return true;
    }
}
