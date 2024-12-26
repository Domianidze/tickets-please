<?php

namespace App\Http\Requests;

class UpdateTicketRequest extends TicketRequest
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
        return [
            'data.status' => 'sometimes|required|string|in:available,taken,expired',
            'data.event' => 'sometimes|required|string|min:3|max:255',
            'data.seat' => 'sometimes|required|integer|min:1|max:100',
            'data.user_id' => auth()->user()->is_admin ? 'sometimes|required|integer|exists:users,id' : 'prohibited',
        ];
    }
}
