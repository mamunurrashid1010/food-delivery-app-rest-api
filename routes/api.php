<?php

use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\RiderLocationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

# rider location
Route::post('store-rider-location',[RiderLocationController::class,'store'])->name('rider.location.store');

# restaurant
Route::apiResource('restaurants', RestaurantController::class);

# nearest rider
Route::get('nearest-rider', [RiderLocationController::class,'nearestRider'])->name('nearest.rider');
