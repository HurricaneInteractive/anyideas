<?php

namespace App\Http\Controllers;

use App\Ideas;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers;
use JavaScript;
use Illuminate\Support\Facades\DB;
use DiscussionController;
use UpdatesPostController;
use TimelineController;

class IdeasController extends Controller
{
    // get currently logged in user
    public function getUser(Request $request) { 
        $user = Auth::user();
        $id = Auth::id();

        if ($user === null) {
            return alert('no logged in user - please login');
        };
        return ['user' => $user, 'id' => $id];
    }
    public function getUserById(Request $request, $id) { 
        $user = User::all()->where('id', $id)->first();
        return ['user' => $user];
    }
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
    public function getByUser($id)
    {
        $ideas = Ideas::all()->where('user_id', $id);
        return $ideas;
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
        $user_id = Auth::id();

        $category_array = json_encode($request->category);
        $tags_array = json_encode($request->tags);

        $idea = new Ideas([
            'user_id' => $user_id,
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
        $status = Ideas::find($id)->first()->update($filtered_idea_data);

        $new_idea_data = $this->getById($id);
        return response()->json([
            'status' => $status,
            'message' => $new_idea_data ? 'Idea updated' : 'Error updating Idea'
        ]);
    }
    public function deleteIdea($idea)
    {
        $idea = $this->getById($idea);

        $discussion_replies_id = DB::table('discussion_replies')->where('idea_id', $idea->id)->delete();
        $discussion_id = DB::table('discussions')->where('idea_id', $idea->id)->delete();
        $timeline_id = DB::table('timelines')->where('idea_id', $idea->id)->delete();
        $updates_posts_id = DB::table('updates_posts')->where('idea_id', $idea->id)->delete();

        $status = $idea->delete();
        return response()->json([
            'discussion_replies_id' => $discussion_replies_id,
            'discussion_id' => $discussion_id,
            'updates_posts_id' => $updates_posts_id,
            'timeline_id' => $timeline_id,
            'idea' => $idea,
            'status' => $status,
            'message' => $status ? 'Idea Deleted!' : 'Error Deleting Idea'
        ]);
    }
}