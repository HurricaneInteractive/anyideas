<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;

// class Users extends Controller
// {
    
// }

namespace App\Http\Controllers;

use App\Ideas;
use App\Timeline;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers;
use JavaScript;

class TimelineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getAll($idea_id)
    {
        $timeline_entries = Timeline::all()->where('idea_id', $idea_id);

        return $timeline_entries;
    }

    public function getById($id)
    {
        

        $timeline_single = Timeline::all()->where('id', $id);

        return $timeline_single;
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