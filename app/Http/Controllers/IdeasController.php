<?php

namespace App\Http\Controllers;

use App\Ideas;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers;
use JavaScript;
use Illuminate\Support\Facades\DB;

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
    }

    public function getByCategory($category)
    {
        $ideas_with_category = Ideas::all()->where('category', $category);

        return $ideas_with_category;
    }

    public function getByTags(Request $request)
    {
        $decoded_tags = preg_split("/[,]/",$request->tags);

        $return_ideas = [''];

        $collection = DB::Table('ideas')->select('*');
        foreach($decoded_tags as $key => $tag) {
            if($key == 0) {
                $collection->where('tags', 'like', '%'.$tag.'%');
            }
            $collection->orWhere('tags', 'like', '%'.$tag.'%');
        }
        $ideas = $collection->get();
        
        return ['ideas' => $ideas];
    }

    // single idea functions

    public function getById($id) {
        $idea = Ideas::all()->where('id', $id)->first();

        return $idea;
    }

    public function createIdea(Request $request)
    {
        $user = '1234';

        $category_array = json_encode($request->category);
        $tags_array = json_encode($request->tags);

        $idea = new Ideas([
            'user_id' => $user,
            'title' => $request->title,
            'category' => $category_array,
            'tags' => $tags_array,
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