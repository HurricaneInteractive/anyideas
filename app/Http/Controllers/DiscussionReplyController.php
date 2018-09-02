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
use JavaScript;
use Illuminate\Support\Facades\DB;

class DiscussionReplyController extends Controller
{
    // get all discussion replies from an idea_id
    public function getAllByDiscId($discussions_id)
    {
        $replies = DiscussionReply::all()->where('discussions_id', $discussions_id);
        return $replies;
    }
    // get single discussion reply from an id
    public function getById($id)
    {
        $discussion_reply = DiscussionReply::all()->where('id', $id)->first();
        return $discussion_reply;
    }
    public function createDiscussionReply(Request $request)
    {
        $new_discussion_reply = new DiscussionReply([
            'user_id' => Auth::id(),
            'idea_id' => $request->idea_id,
            'discussions_id' => $request->discussions_id,
            'message' => $request->message
        ]);

        $new_discussion_reply->save();
        return $new_discussion_reply;
    }
    public function updateIdea(Request $request, $id)
    {
        $filtered_discussion_reply_data = collect(request()->all())->filter()->all();
        $status = DiscussionReply::find($id)->first()->update($filtered_discussion_reply_data);

        $new_discussion_reply_data = $this->getById($id);
        return response()->json([
            'status' => $status,
            'message' => $new_discussion_reply_data ? 'Discussion Reply updated' : 'Error updating Discussion Reply'
        ]);
    }
    public function upDownVote($reply_id, $vote)
    {
        if ($vote === 'down') {
            $new_votes = $this->getById($reply_id)->down_votes + 1;
            DB::table('discussion_replies')
            ->where('id', $reply_id)
            ->update(['down_votes' => $new_votes]);
        }
        else {
            $new_votes = $this->getById($reply_id)->up_votes + 1;
            DB::table('discussion_replies')
            ->where('id', $reply_id)
            ->update(['up_votes' => $new_votes]);
        }

        $reply_item = $this->getById($reply_id);
        return response()->json([
            'reply_item' => $reply_item,
            'reply_id' => $reply_id,
            'vote' => $vote,
            'message' => $reply_item ? 'Vote updated' : 'Error updating Vote'
        ]);
    }
    public function deleteEntry($id)
    {
        $id = $this->getById($id);
        $status = $id->delete();

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Discussion Reply Deleted!' : 'Error Deleting Discussion Reply'
        ]);
    }
}