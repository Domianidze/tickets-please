<?php

namespace App\Http\Controllers;

use App\Http\Filters\UserFilters;
use App\Http\Requests\ModifyUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UserFilters $filters)
    {
        return UserResource::collection(User::filters($filters)->simplePaginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ModifyUserRequest $request)
    {
        $validated = $request->validated()['data'];

        $user = User::create($validated);

        return UserResource::make($user);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return UserResource::make($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ModifyUserRequest $request, User $user)
    {
        Gate::authorize('modify', $user);

        $validated = $request->validated()['data'];

        $user->update($validated);

        return UserResource::make($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        Gate::authorize('modify', $user);

        $user->delete();

        return response()->json([
            'message' => 'Deleted successfully.',
        ], 200);
    }
}
