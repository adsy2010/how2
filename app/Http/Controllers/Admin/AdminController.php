<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Traits\Logging;
use App\Traits\Role;

class AdminController extends Controller
{
    use Role;
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
        if($this->permissions('Administrator')){
            return view('admin.Dashboard');
        }
        return redirect()->to(Route('home'))->withErrors('You do not have the Administrator privilege.');
    }

    use Logging;
    public function logs()
    {
        return view('admin.logs', ['logs' => $this->retrieveLogs()]);
    }
}
