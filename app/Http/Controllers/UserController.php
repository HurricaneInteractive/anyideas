<?php

namespace App\Http\Controllers;

use App\Ideas;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
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

    public function getUserById($id) {

        $res = array();

        $user = User::all()->where('id', $id)->first();
        $meta = DB::table('user_meta_datas')->where('user_id', $id)->first();

        $res['user'] = $user;
        $res['user_meta'] = $meta;
        
        if (isset($user->interests)) {
            $res['interests'] = json_decode($user->interests);
        }

        if (!is_null($meta) && isset($meta->social_media)) {
            $res['social_media'] = json_decode($meta->social_media);
        }

        return response()->json($res);
    }

    public function updateUser($user_meta) {
        $data = $request->user_meta_update;
        return response()->json([
            'data' => $data
        ]);
    }

    public function validateRegisterField(Request $request) {
        $field = $request['key'];
        $value = $request['value'];
        $user = User::where($field, $value)->first();

        return response()->json([
            'user' => $user
        ]);
    }
}
