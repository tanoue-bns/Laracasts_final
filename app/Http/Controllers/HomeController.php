<?php

namespace App\Http\Controllers;

use App\Tweet;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $tweets = auth()->user()->timeline();

        return view('home', [
            'tweets' => $tweets
        ]);
    }
}
