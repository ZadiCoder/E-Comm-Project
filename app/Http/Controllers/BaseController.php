<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    function show()
    {
        return view('front.home');
    }
    function specialOffer()
    {
        return view('front.specialoffer');
    }
    function delivery()
    {
        return view('front.delivery');
    }
    function contact()
    {
        return view('front.contact');
    }
    function cart()
    {
        return view('front.cart');
    }
    function productView()
    {
        return view('front.productView');
    }
}
