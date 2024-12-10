<?php

namespace App\Http\Controllers;

use App\Http\Filters\TicketFilters;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Http\Resources\TicketResource;
use App\Models\Ticket;
use Illuminate\Support\Facades\Gate;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TicketFilters $filters)
    {
        return TicketResource::collection(Ticket::filters($filters)->simplePaginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketRequest $request)
    {
        $validated = $request->validated()['data'];
        $user = $request->user();

        $ticket = Ticket::create([...$validated, 'user_id' => $user->id]);

        return TicketResource::make($ticket);
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        return TicketResource::make($ticket);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        Gate::authorize('modify', $ticket);

        $validated = $request->validated()['data'];

        $ticket->update($validated);

        return TicketResource::make($ticket);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        Gate::authorize('modify', $ticket);

        $ticket->delete();

        return response()->json([
            'message' => 'Deleted successfully.',
        ], 200);
    }
}
