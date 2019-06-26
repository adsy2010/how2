<?php

namespace App\Http\Controllers;

use App\Guide;
use Illuminate\Http\Request;

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
        return view('home');
    }

    public function welcome()
    {
        return view('welcome', ['guides' => Guide::where('published', 1)->orderBy('publishedTimestamp', 'DESC')->limit(6)->get()]);
    }
}
