<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class BaseController extends Controller
{
    function show()
    {
        $products = Product::get();
        $new_products = Product::limit(6)->latest()->get();
        return view('front.home',compact('products','new_products'));
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
    function productView(Request $request)
    {
        $id = $request->id;
        $product = Product::where('id', $id)->with('ProductDetail')->first();
        $category_id = $product->category_id;
        $related_products = Product::where('category_id',$category_id)->get();
        return view('front.productView',compact('product','related_products'));
    }
}
