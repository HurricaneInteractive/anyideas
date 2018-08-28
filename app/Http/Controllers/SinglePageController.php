<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use JavaScript;

class SinglePageController extends Controller
{
    //
    public function index() {

        $user_data = null;
        if (Auth::user() !== null) {
            $user_data = Auth::user();
        }

        JavaScript::put([
            'user_data' => $user_data
        ]);

        return view('/index', ['userData' => $user_data]);
    }
    public function userData() {
        // $user->json = json_encode(array('test-key' => 'test-data'));

        $user_data = null;
        if (Auth::user() !== null) {
            $user_data = Auth::user();
        }

        JavaScript::put([
            'user_data' => $user_data
        ]);

        return view('/index', ['userData' => $user_data]);
    }
}
