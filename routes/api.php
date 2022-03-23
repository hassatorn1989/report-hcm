<?php

use App\Http\Controllers\api\empoyee_controller;
use App\Http\Controllers\api\time_controller;
use Illuminate\Http\Request;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::middleware('auth.apikey')->group( function () {
    Route::get('/empoyee', [empoyee_controller::class, 'index']);
    Route::get('/time', [time_controller::class, 'index']);
});

