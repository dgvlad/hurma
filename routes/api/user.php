<?php


use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


Route::post('user/login',[AuthController::class, 'userLogin'])->name('userLogin');

Route::group( ['prefix' => 'user','middleware' => ['auth:api-user','scopes:user'] ],function(){
    // authenticated staff routes here
//    Route::get('dashboard',[AuthController::class, 'adminDashboard']);
});
