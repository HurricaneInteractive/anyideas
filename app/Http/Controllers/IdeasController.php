<?php

namespace App\Http\Controllers;

use App\Ideas;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers;
use JavaScript;

class IdeasController extends Controller
{
    // multiple idea functions

    public function getAll()
    {
        $ideas = Ideas::all();

        return $ideas;
    }

    public function getByTitle($title)
    {
        $ideas = Ideas::all()->where('title', $title);

        return $ideas;

        return 'Im sorry, it looks like our developer hasnt created this route yet';
    }

    public function getByCategory($id)
    {
        return 'Im sorry, it looks like our developer hasnt created this route yet';
    }

    public function getByTags($id)
    {
        return 'Im sorry, it looks like our developer hasnt created this route yet';
    }

    // single idea functions

    public function getById($id) {
        $idea = Ideas::find($id)->first();

        return $idea;
    }

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

    public function updateIdea(Request $request, $id)
    {
        $filtered_idea_data = collect(request()->all())->filter()->all();

        $edit_this_idea = Ideas::find($id)->first()->update($filtered_idea_data);

        $new_idea_data = $this->getById($id);

        return response()->json([
            'status' => $edit_this_idea,
            'message' => $new_idea_data ? 'Idea updated' : 'Error updating Idea'
        ]);
    }

    public function deleteIdea($idea)
    {
        $idea = $this->getById($idea);
        $status = $idea->delete();

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Idea Deleted!' : 'Error Deleting Idea'
        ]);

    }
}