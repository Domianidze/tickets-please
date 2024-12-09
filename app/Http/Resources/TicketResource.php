<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'event' => $this->event,
            $this->mergeWhen(!$request->routeIs('tickets.index'), [
                'seat' => $this->seat,
                'createdAt' => $this->created_at,
                'updatedAt' => $this->updated_at,
                'user' => UserResource::make($this->user),
            ])
        ];
    }
}
