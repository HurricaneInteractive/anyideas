<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    public function index() {
        return view('/index');
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
    }
    

    // public function logout(Request $request)
    // {

    //     Auth::logout();
    //     // $this->guard()->logout();

    //     // $request->session()->invalidate();

    //     // if ($request->wantsJson()) {
    //     //     return response()->json([], 204);
    //     // }

    //     // $request->session()->regenerate();       

    //     return redirect('/index');
    // }
}
