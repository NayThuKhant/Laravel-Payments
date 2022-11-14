<?php

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

Route::post('/backend-url', function(Request $request) {
    Log::info($request);
})->name('backend');
Route::post('/2c2p/callback', function(Request $request) {
    Log::info($request);
})->name('2c2p.callback');