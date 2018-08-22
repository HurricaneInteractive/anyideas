<?php

namespace App\Http\Controllers;
use JWTAuth;
use App\User;
use JavaScript;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $token = auth()->login($user);

        $user_data = null;
        // if (Auth::user() !== null) {
        //     $user_data = Auth::user();
        // }

        JavaScript::put([
            'user_data' => $user_data
        ]);

        return $this->respondWithToken($token);
    }

    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        // response()->json(['error' => 'console loggo?'], 401);
        $user_data = null;
        // if (JWTAuth::toUser($token) !== null) {
        //     $user_data = JWTAuth::toUser($token);
        // }
        if (JWTAuth::fromUser($user) !== null) {
            $user_data = JWTAuth::fromUser($user);
        }

        JavaScript::put([
            'user_data' => $user_data
        ]);
        view('/index', ['userData' => $user_data]);
        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
