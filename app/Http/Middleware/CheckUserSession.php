<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckUserSession
{
    public function handle($request, Closure $next)
    {
        // Check session data
        if (Session::get('user_ft') == '') {
            return redirect()->route('Userlogin'); // Adjust route name as needed
        }

        return $next($request);
    }
}
