<?php

namespace App\Http\Controllers;

use App\Http\Requests\PriorityStoreRequest;
use App\Models\Priorities;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class PriorityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $priorities = Priorities::paginate(20);

        return response()->json($priorities, Response::HTTP_ACCEPTED);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PriorityStoreRequest $request)
    {
        $validated = $request->validated();

        DB::transaction();
        try{
            $priority = new Priorities();

            $priority->name = $validated['name'];

            $priority->save();

            DB::commit();
            return response()->json($priority, Response::HTTP_ACCEPTED);
        }catch(Exception $e){
            return response()->json($e, Response::HTTP_BAD_GATEWAY);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $priority = Priorities::findOrFail($id);

        return response()->json($priority, Response::HTTP_ACCEPTED);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PriorityStoreRequest $request, string $id)
    {
        $validated = $request->validated();

        DB::transaction();
        try{
            $priority = Priorities::findOrFail($id);

            $priority->name = $validated['name'];

            $priority->save();

            DB::commit();
            return response()->json($priority, Response::HTTP_ACCEPTED);
        }catch(Exception $e){
            return response()->json($e, Response::HTTP_BAD_GATEWAY);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $priority = Priorities::findOrFail($id);

        $priority->destroy();

        return response()->noContent();
    }
}
