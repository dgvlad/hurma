<?php


use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('client/login',[AuthController::class, 'clientLogin'])->name('clientLogin');

Route::post('client/signup',[AuthController::class, 'signupCode'])->name('clientSignup');

Route::group( ['prefix' => 'client','middleware' => ['auth:api-client','scopes:client'] ],function(){
    // authenticated staff routes here
//    Route::get('dashboard',[AuthController::class, 'adminDashboard']);
});
