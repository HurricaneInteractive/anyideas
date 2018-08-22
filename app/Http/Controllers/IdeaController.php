<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Idea;
use App\Http\Resources\IdeaResource;

class IdeaController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth:api')->except(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // may need parameters
        return IdeaResource::collection(Idea); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $idea = Idea::create([
            'user_id' => $request->user()->id,
            'id' => $request->id,
            'title' => $request->title,
            'pitch' => $request->pitch,
            'status' => $request->status,
            'tags' => $request->tags,
            'description' => $request->description,
            'darts' => $request->darts,
            'image' => $request->image
        ])

        return new IdeaResource($idea);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Idea $idea)
    {
        //
        return new IdeaResource($idea);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Idea $idea)
    {
        //
        if ($request->user()-id !== $idea->user_id) {
            return response()->json(['you can only edit your own ideas']);
        }

        $idea->update($request->only(['title', 'status']));

        return new IdeaResource($idea);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Idea $idea)
    {
        $idea->delete();

        return response()->json(null, 204);
    }
}
