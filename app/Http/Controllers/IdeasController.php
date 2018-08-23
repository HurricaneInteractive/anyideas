<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;

// class Users extends Controller
// {
    
// }

namespace App\Http\Controllers;

use App\Ideas;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers;
use JavaScript;

class IdeasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // Eloquent shizzle
        $ideas = Ideas::all();

        // $allOfTheIdeas[] = array();

        // foreach ($ideas as $idea) {
        //     $allOfTheIdeas[] = $idea;
        // }

        JavaScript::put([
            'ideas' => $ideas
        ]);

        return (['idea_data' => $ideas]);
    }

    public function indexSingle($id) {
        $idea = Ideas::all()->where('id', $id)->first();

        // JavaScript::put([
        //     'data_of_idea' => $idea
        // ]);
        return $idea;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function createIdea(Request $request)
    {

        $idea = new Ideas([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'pitch' => $request->pitch,
            'status' => $request->status,
            'description' => $request->description
        ]);

        $idea->save();

        return $idea;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {

        // $idea = Idea::create([
        //     'title' => $request->title,
        //     'pitch' => $request->pitch,
        //     'status' => $request->status,
        //     'description' => $request->description
        // ]);

        // $data = [
        //     'data' => $idea,
        //     'status' => (bool) $idea,
        //     'message' => $idea ? 'Idea Created' : 'Error Creating Idea',
        // ];

        // return response()->json($data);
        return 'store function goes here';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($idea)
    {
        // return view('ideas',array('title' => $title));
        return response()->json($idea);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($idea)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $idea)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($idea)
    {
        //
        $status = $idea->delete();

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Idea Deleted!' : 'Error Deleting Idea'
        ]);

    }
}