<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
{
    public function messages(): array
    {
        return [
            'data.status.in' => 'The data.status field must be one of the following: available, taken, expired.',
        ];
    }
}
