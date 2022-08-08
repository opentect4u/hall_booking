<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct() {
        $this->middleware('auth:frontuser');
    }

    public function Index(Request $request)
    {
        return view('user.dashboard');
    }
}
