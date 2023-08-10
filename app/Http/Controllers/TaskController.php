<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStoreRequest;
use App\Models\Task;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::paginate(20);

        return response()->json($tasks, Response::HTTP_ACCEPTED);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskStoreRequest $request)
    {
        $valdiated = $request->validated();

        DB::transaction();
        try{
            $task = new Task();

            $task->activity = $valdiated['activity'];
            $task->description = $valdiated['description'];
            $task->user_id = $valdiated['user_id'];
            $task->tag_id = $valdiated['tag_id'];
            $task->priority_id = $valdiated['priority_id'];

            $task->save();

            DB::commit();
            return response()->json($task, Response::HTTP_ACCEPTED);
        }catch(Exception $e){
            return response()->json($e, Response::HTTP_ACCEPTED);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::findOrFail($id);

        return response()->json($task, Response::HTTP_ACCEPTED);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $valdiated = $request->validated();

        DB::transaction();
        try{
            $task = Task::findOrFail($id);

            $task->activity = $valdiated['activity'];
            $task->description = $valdiated['description'];
            $task->user_id = $valdiated['user_id'];
            $task->tag_id = $valdiated['tag_id'];
            $task->priority_id = $valdiated['priority_id'];

            $task->save();

            DB::commit();
            return response()->json($task, Response::HTTP_ACCEPTED);
        }catch(Exception $e){
            return response()->json($e, Response::HTTP_ACCEPTED);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::findOrFail($id);

        $task->destroy();

        return response()->noContent();
    }
}
