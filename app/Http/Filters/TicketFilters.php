<?php

namespace App\Http\Filters;

class TicketFilters extends Filters
{
    protected array $sortable = ['index' => 'id', 'status', 'event'];

    public function status(string $value)
    {
        return $this->builder->whereIn('status', explode(',', $value));
    }

    public function search(string $value)
    {
        return $this->builder->where('event', 'like', '%' . $value . '%');
    }
}
