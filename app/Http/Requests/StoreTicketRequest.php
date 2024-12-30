<?php

namespace App\Http\Requests;

class StoreTicketRequest extends TicketRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'data.status' => 'required|string|in:available,taken,expired',
            'data.event' => 'required|string|min:3|max:255',
            'data.seat' => 'required|integer|min:1|max:100',
        ];

        if (request()->routeIs('tickets.store')) {
            $rules['data.user_id'] = auth()->user()->is_admin ? 'sometimes|required|integer|exists:users,id' : 'prohibited';
        }

        return $rules;
    }
}
