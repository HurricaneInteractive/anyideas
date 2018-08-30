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
    // get single discussion reply from an id
    public function getById($id)
    {
        $discussion_reply = DiscussionReply::all()->where('id', $id)->first();

        return $discussion_reply;
    }

    public function createDiscussionReply(Request $request)
    {
        $new_discussion_reply = new Discussionreply([
            'user_id' => Auth::id(),
            'idea_id' => $request->idea_id,
            'discussion_id' => $request->discussion_id,
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

    public function deleteEntry($id)
    {
        $id = $this->getById($id);
        //get discussion replies here + delete them before deleting the discussion
        $status = $id->delete();

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Discussion Reply Deleted!' : 'Error Deleting Discussion Reply'
        ]);

    }
}