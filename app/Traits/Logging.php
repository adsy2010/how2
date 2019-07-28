<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 28/07/2019
 * Time: 21:48
 */

namespace App\Traits;


use App\Log;
use Illuminate\Support\Facades\Auth;

trait Logging
{
    public function createLog($action)
    {

        Log::create([
            'user' => Auth::id(),
            'action' => $action
        ]);
    }

    public function retrieveLogs($user = null)
    {
        if($user == null)
            return Log::orderBy('created_at', 'DESC')->paginate(50);

        return Log::where('user', $user)->orderBy('created_at')->paginate(50);
    }
}