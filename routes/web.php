<?php

use Illuminate\Support\Facades\Route;
use Laranex\LaravelMyanmarPayments\LaravelMyanmarPaymentsFacade;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function() {
    $items = [
        ["name" => "Product 1", "amount" => 10000],
        ["name" => "Product 2", "amount" => 10000]
    ];

    $orderId = Str::random(6);
    $amount = 100;
    $merchantReferenceId = Str::random(6);
    $backendResultUrl = route("backend");

    $url = LaravelMyanmarPaymentsFacade::channel('wave_money')->getPaymentScreenUrl($items, $orderId, $amount, $merchantReferenceId, $backendResultUrl);

    return redirect($url);

})->name('frontend');


