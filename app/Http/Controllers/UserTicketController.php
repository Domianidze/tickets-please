<?php

namespace App\Http\Controllers;

use App\Http\Filters\TicketFilters;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Http\Resources\TicketResource;
use App\Models\Ticket;
use App\Models\User;
use Gate;

class UserTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TicketFilters $filters, User $user)
    {
        return TicketResource::collection($user->tickets()->filters($filters)->simplePaginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketRequest $request, User $user)
    {
        $validated = $request->validated()['data'];
        $validated['user_id'] = $user->id;

        $ticket = Ticket::create($validated);

        return TicketResource::make($ticket);
    }

    /**
     * Display the specified resource.
     */
    public function show($_, Ticket $ticket)
    {
        return TicketResource::make($ticket);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTicketRequest $request, $_, Ticket $ticket)
    {
        Gate::authorize('modify', $ticket);

        $validated = $request->validated()['data'];

        $ticket->update($validated);

        return TicketResource::make($ticket);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($_, Ticket $ticket)
    {
        Gate::authorize('modify', $ticket);

        $ticket->delete();

        return response()->json([
            'message' => 'Deleted successfully.',
        ], 200);
    }
}
