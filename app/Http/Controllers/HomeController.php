<?php

namespace App\Http\Controllers;

use App\Ideas;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    private $default_category = 'arts';
    private $recent_limit = 5;
    private $category_limit = 5;

    private function defineFetchDirection() {
        if (Auth::check()) {
            $interests = json_decode(Auth::user()->interests);
            if (count($interests) > 1) {
                $this->default_category = $interests[0];
            }
        }
    }

    public function getFeedData(Request $request) {
        $this->defineFetchDirection();

        $recent_ideas = Ideas::orderBy('created_at', 'desc')
            ->take($this->recent_limit)
            ->get();
        
        $category_ideas = Ideas::whereIn('category', [$this->default_category])
            ->orderBy('created_at', 'desc')
            ->take($this->category_limit)
            ->get();

        return response()->json(array(
            'recent_ideas' => $recent_ideas,
            'category_data' => $category_ideas
        ));
    }
}
