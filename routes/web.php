<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BaseController;


Route::get('/home',[BaseController::class,'show'])->name('home');
Route::get('/specialoffer',[BaseController::class,'specialOffer'])->name('specialOffer');
Route::get('/delivery',[BaseController::class,'delivery'])->name('delivery');
Route::get('/contact-us',[BaseController::class,'contact'])->name('contact');


