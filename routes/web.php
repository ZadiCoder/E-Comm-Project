<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;

Route::get('/',[BaseController::class,'show'])->name('home');
Route::get('/specialoffer',[BaseController::class,'specialOffer'])->name('specialOffer');
Route::get('/delivery',[BaseController::class,'delivery'])->name('delivery');
Route::get('/contact-us',[BaseController::class,'contact'])->name('contact');
Route::get('/cart',[BaseController::class,'cart'])->name('cart');
Route::get('/productView',[BaseController::class,'productView'])->name('productView');
Route::get('/admin/login',[AdminController::class,'login'])->name('admin.login');
Route::post('/admin/login',[AdminController::class,'makeLogin'])->name('admin.makeLogin');


Route::group(['middleware' => 'auth'], function(){
    Route::get('/admin/dashboard',[AdminController::class,'dashboard'])->name('admin.dashboard');
    Route::get('/admin/logout',[AdminController::class,'logout'])->name('admin.logout');

    /* CategoryController <Routes></Routes>*/
    Route::get('/category/add',[CategoryController::class,'create'])->name('category.create');
    Route::post('/category/add',[CategoryController::class,'store'])->name('category.store');
});