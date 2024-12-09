<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class Filters
{
    protected Request $request;
    protected Builder $builder;
    protected array $sortable;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    protected function methods(array $value)
    {
        foreach ($value as $key => $value) {
            if (method_exists($this, $key)) {
                $this->$key($value);
            }
        }
    }

    protected function filter(array $filters)
    {
        $this->methods($filters);
    }

    protected function sort(string $value)
    {
        $values = explode(',', $value);

        foreach ($values as $value) {
            $direction = 'asc';

            if (strpos($value, '-') === 0) {
                $direction = 'desc';

                $value = substr($value, 1);
            }

            if (in_array($value, $this->sortable) || array_key_exists($value, $this->sortable)) {
                $value = $this->sortable[$value] ?? $value;

                $this->builder->orderBy($value, $direction);
            }
        }
    }

    public function apply(Builder $builder)
    {
        $this->builder = $builder;

        $this->methods($this->request->all());

        return $this->builder;
    }
};
