<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    function show()
    {
        return view('front.home');
    }
}
