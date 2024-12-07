<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class Filters
{
    protected Request $request;
    protected Builder $builder;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply(Builder $builder)
    {
        $this->builder = $builder;

        $this->methods($this->request->all());

        return $this->builder;
    }

    protected function filter(array $filters)
    {
        $this->methods($filters);
    }

    protected function methods(array $value)
    {
        foreach ($value as $key => $value) {
            if (method_exists($this, $key)) {
                $this->$key($value);
            }
        }
    }
};
