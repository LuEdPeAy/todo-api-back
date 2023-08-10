<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(20);

        return response()->json($users, Response::HTTP_ACCEPTED);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        $validated = $request->validated();

        $user = new User();

        $user->name = $validated['name'];
        $user->last_name = $validated['last_name'];
        $user->username = $validated['username'];
        $user->password = $validated['password'];

        $user->save();

        return response()->json($user, Response::HTTP_ACCEPTED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);

        return response()->json($user, Response::HTTP_ACCEPTED);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserStoreRequest $request, string $id)
    {

        $validated = $request->validated();

        $user = User::findOrFail($id);

        $user->name = $validated['name'];
        $user->last_name = $validated['last_name'];
        $user->username = $validated['username'];
        $user->password = $validated['password'];

        $user->save();

        return response()->json($user, Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        $user->destroy();

        return response()->noContent();
    }
}
