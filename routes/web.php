<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductBookingController;

Route::get('/',[BaseController::class,'show'])->name('home');
Route::get('/specialoffer',[BaseController::class,'specialOffer'])->name('specialOffer');
Route::get('/delivery',[BaseController::class,'delivery'])->name('delivery');
Route::get('/contact-us',[BaseController::class,'contact'])->name('contact');
Route::get('/cart',[BaseController::class,'cart'])->name('cart');
Route::get('/productView/{id}',[BaseController::class,'productView'])->name('productView');
Route::get('/admin/login',[AdminController::class,'login'])->name('admin.login');
Route::post('/admin/login',[AdminController::class,'makeLogin'])->name('admin.makeLogin');
Route::get('/user/login',[BaseController::class,'user_login'])->name('user_login');
Route::post('/user/login',[BaseController::class,'loginCheck'])->name('loginCheck');
Route::post('/user/register',[BaseController::class,'user_store'])->name('user_store');
Route::get('/user/logout',[BaseController::class,'logout'])->name('user_logout');


Route::group(['middleware' => 'auth'], function(){
    Route::get('/admin/dashboard',[AdminController::class,'dashboard'])->name('admin.dashboard');
    Route::get('/admin/logout',[AdminController::class,'logout'])->name('admin.logout');

    /*CartController Routes */
    Route::post('/cart/store',[CartController::class,'store'])->name('cart.store');
    Route::get('/cart/delete',[CartController::class,'destroy'])->name('cart.delete');

    /*BookingController Routes */
    Route::post('/product/booking',[ProductBookingController::class,'store'])->name('product.booking');
   
    
      /*Eway Routes */
      Route::get('/product/bookingSuccess',[ProductBookingController::class,'bookingSuccess'])->name('product.bookingSuccess');
      Route::get('/product/bookingFail',[ProductBookingController::class,'bookingFail'])->name('product.bookingFail');
    /* CategoryController <Routes></Routes>*/
    Route::get('/categories',[CategoryController::class,'index'])->name('category.list');
    Route::get('/category/add',[CategoryController::class,'create'])->name('category.create');
    Route::post('/category/add',[CategoryController::class,'store'])->name('category.store');
    Route::get('/categories/edit/{id}',[CategoryController::class,'edit'])->name('category.edit');
    Route::post('/categories/edit/{id}',[CategoryController::class,'update'])->name('category.update');
    Route::get('/categories/delete',[CategoryController::class,'destroy'])->name('category.delete');

    /*ProductController Routes */
    Route::get('/products',[ProductController::class,'index'])->name('product.list');
    Route::get('/product/create',[ProductController::class,'create'])->name('product.create');
    Route::post('/product/create',[ProductController::class,'store'])->name('product.store');
    Route::get('/product/edit/{id}',[ProductController::class,'edit'])->name('product.edit');
    Route::post('/product/edit/{id}',[ProductController::class,'update'])->name('product.update');
    Route::get('/product/delete',[ProductController::class,'destroy'])->name('product.delete');

    Route::get('/product/details/{id}',[ProductController::class,'extraDetails'])->name('product.extraDetails');
    Route::post('/product/details/{id}',[ProductController::class,'extraDetailsStore'])->name('product.extraDetailsStore');

        //Booking Route
    Route::get('booking/products',[ProductBookingController::class,'index'])->name('booking.products');
    Route::get('booking/products/delete',[ProductBookingController::class,'destroy'])->name('booking.product.delete');
    Route::get('booking/product-status',[ProductBookingController::class,'change_bookingStatus'])->name('booking.product.status');
    
    Route::get('/admin/users',[UserController::class,'index'])->name('admin.users');
    Route::get('/admin/delete',[UserController::class,'delete'])->name('user.delete');
});