<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagStoreRequest;
use App\Models\Tag;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::paginate(20);

        return response()->json($tags, Response::HTTP_ACCEPTED);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TagStoreRequest $request)
    {
        $validated = $request->validated();

        $tag = new Tag();

        DB::transaction();
        try{
            $tag->name = $validated['name'];
            $tag->user_id = $validated['user_id'];

            $tag->save();

            DB::commit();

            return response()->json($tag, Response::HTTP_ACCEPTED);
        }catch(Exception $e){
            DB::rollBack();
            return response()->json($e, Response::HTTP_BAD_GATEWAY);
        }        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tag = Tag::findOrfail($id);

        return response()->json($tag, Response::HTTP_ACCEPTED);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TagStoreRequest $request, string $id)
    {
        $validated = $request->validated();

        DB::transaction();
        try{
            $tag = Tag::findOrfail($id);

            $tag->name = $validated['name'];
            $tag->user_id = $validated['user_id'];

            $tag->save();

            DB::commit();
            return response()->json($tag, Response::HTTP_ACCEPTED);
        }catch(Exception $e){
            DB::rollBack();
            return response()->json($e, Response::HTTP_BAD_GATEWAY);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tag = Tag::findOrfail($id);

        $tag->destroy();

        return response()->noContent();
    }
}
