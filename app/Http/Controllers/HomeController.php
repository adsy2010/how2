<?php

namespace App\Http\Controllers;

use App\Feedback;
use App\Guide;
use App\Traits\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function dashboard()
    {
        return view('user.dashboard');
    }

    public function submissions()
    {
        $drafts = Guide::where('publisher', Auth::id())->where('draft', '1')->paginate(4,['*'], 'drafts');
        $published = Guide::where('publisher', Auth::id())->where('published', '1')->paginate(4, ['*'], 'published');
        return view('user.submissions', ['drafts' => $drafts, 'published' => $published]);
    }

    public function feedback()
    {
        $feedbackgiven = Feedback::where('user', Auth::id())->orderBy('created_at', 'DESC')->paginate(5);
        $feedbackreceived2 = "";
        $feedbackreceived = Guide::has('feedback')->where('publisher', Auth::id())->paginate(5);

        return view('user.feedback', ['feedback' => $feedbackgiven, 'received' => $feedbackreceived, 'received2' => $feedbackreceived2]);
    }

    public function welcome()
    {
        return view('welcome', ['guides' => Guide::where('published', 1)->orderBy('publishedTimestamp', 'DESC')->limit(6)->get()]);
    }

    use Role;

    public function test()
    {
        return $this->permissions('Feedback');
    }

}
