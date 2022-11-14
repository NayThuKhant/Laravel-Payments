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

Route::get('/',  function () {
    return view("welcome");
});

Route::get('/wave', function() {
    $items = [
        ["name" => "Payment for YLA", "amount" => 10000],
    ];

    $orderId = Str::random(6);
    $amount = 100;
    $merchantReferenceId = Str::random(6);
    $backendResultUrl = route("backend");

    $url = LaravelMyanmarPaymentsFacade::channel('wave_money')
        ->getPaymentScreenUrl($items, $orderId, $amount, $merchantReferenceId, $backendResultUrl);

    return redirect($url);

})->name('wave');

Route::get('/2c2p', function() {
    $orderId = 'yla-'.time();
    $amount = 100;
    $noneStr = time();
    $frontendResultUrl = config("app.url");
    $backendResultUrl = route("2c2p.callback");
    $paymentDescription = "Paywith 2c2p payment gateway";
    $currencyCode = "MMK";

    $url = LaravelMyanmarPaymentsFacade::channel('2c2p')
        ->getPaymentScreenUrl($orderId, $amount, $noneStr, $backendResultUrl,$currencyCode, $frontendResultUrl, $paymentDescription);

    return redirect($url);

})->name('2c2p');
