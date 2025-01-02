<?php

namespace App\Http\Filters;

class UserFilters extends Filters
{
    protected array $sortable = ['index' => 'id', 'name', 'email'];

    public function search(string $value)
    {
        return $this->builder->where('name', 'like', '%' . $value . '%')->orWhere('email', 'like', '%' . $value . '%');
    }
}
