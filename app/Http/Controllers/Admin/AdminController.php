<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * AdminController constructor.
     * Prevent users who are not logged in accessing these methods
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Displays an admin dashboard
     */
    public function dashboard()
    {
        return view('admin.dashboard');
    }
}