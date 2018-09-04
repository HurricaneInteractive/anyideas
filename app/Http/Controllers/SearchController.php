<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Ideas as Ideas;
use App\User as User;
use JavaScript;

class SearchController extends Controller
{

    public function searchQuery(Request $request) {

        // Ideas::search('any')->where('title', 'any')->get();
        $keyword = $request->search;

        $ideasQuery = [];
        $usersQuery = [];

        $ideasQuery = Ideas::when($keyword, function ($q) use($keyword) {
            $q->where('title', 'like', '%' . $keyword . '%')
            ->orWhere('category', 'like', '%' . $keyword . '%')
            ->orWhere('tags', 'like', '%' . $keyword . '%');
            return $q;
        })->get();

        $usersQuery = User::when($keyword, function ($q) use($keyword) {
            $q->where('username', 'like', '%' . $keyword . '%')
            ->orWhere('name', 'like', '%' . $keyword . '%');
            return $q;
        })->get();

        if ($ideasQuery === []) {
            $ideasQuery = ['cheese', 'potato'];
        }

        // $allResults = array_merge($ideasQuery, $usersQuery);



        return response()->json([
            'keyword' => $keyword,
            'ideasQuery' => $ideasQuery,
            'usersQuery' => $usersQuery,
            // 'allResults' => $allResults
        ]);

        // $discussion_replies_id = DB::table('discussion_replies')->where('idea_id', $request->search);
        // $discussion_id = DB::table('discussions')->where('idea_id', $request->search);
        // $timeline_id = DB::table('timelines')->where('idea_id', $request->search);
        // $updates_posts_id = DB::table('updates_posts')->where('idea_id', $request->search);
    }
}
