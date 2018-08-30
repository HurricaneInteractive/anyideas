<?php

namespace App\Http\Controllers;

use App\Ideas;
use App\User;
use App\Discussion;
use App\DiscussionReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers;
use Illuminate\Database\Eloquent\Collection;
use JavaScript;
use Illuminate\Support\Facades\DB;

class DiscussionController extends Controller
{
    // get all discussions from an idea_id
    public function getAll($idea_id)
    {
        $discussions = Discussion::all()->where('idea_id', $idea_id);

        return $discussions;
    }

    // public function getAllReplies($id)
    // {
    //     $discussion_replies = DiscussionReply::all()->where('discussion_id', $id)->get();

    //     return $discussion_replies;
    // }

    public function getById($discussion_id)
    {
        $discussion_item = Discussion::all()->where('id', $discussion_id)->first();

        return $discussion_item;
    }

    public function createDiscussion(Request $request)
    {

        $new_discussion = new Discussion([
            'user_id' => Auth::id(),
            'idea_id' => $request->idea_id,
            'title' => $request->title,
            'message' => $request->message
        ]);

        $new_discussion->save();

        return $new_discussion;
    }

    public function updateIdea(Request $request, $id)
    {
        $filtered_discussion_data = collect(request()->all())->filter()->all();

        $status = Discussion::find($id)->first()->update($filtered_discussion_data);

        $new_idea_data = $this->getById($id);

        return response()->json([
            'status' => $status,
            'message' => $new_idea_data ? 'Idea updated' : 'Error updating Idea'
        ]);
    }

    public function deleteEntry($id)
    {
        $discussion_id = $this->getById($id);
        //get discussion replies here + delete them before deleting the discussion
        $replies = DB::table('discussion_replies')
            ->where('discussions_id', $discussion_id->id)
            ->get();

        // $status_replies = $replies->all()->delete();

        // $delete_the_replies = array_map(function($item){ return $item['id']; }, $replies);

        // DB::table('discussion_replies')->whereIn('discussion_id', $delete_the_replies)->delete(); 
            
        // $status = $discussion_id->delete();

        return response()->json([
            'status' => $status,
            // 'delete_the_replies' => $delete_the_replies,
            'replies' => $replies,
            'id' => $id,
            'message' => $id ? 'Idea Deleted!' : 'Error Deleting Idea'
        ]);

    }
}