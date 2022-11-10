<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
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

    $url =  LaravelMyanmarPaymentsFacade::channel('wave_money')->getPaymentScreenUrl($items, $orderId, $amount, $merchantReferenceId, $backendResultUrl);

    dd($url);

    
    $orderId = Str::random(6);

    $data = [
    'time_to_live_in_seconds' => 300,
    'merchant_name' => "Pun Hlaing",
    'merchant_id' => "punhlainghospitalswmmerchant",
    'order_id' => $orderId,
    'amount' => 100,
    'backend_result_url' => route('backend'),
    'frontend_result_url' => route('frontend'),
    'merchant_reference_id' => $orderId,
    'payment_description' => "<<Merchant Payment Description e.g. Purchase of Item X>>"
];




$items = json_encode([
	['name' => "Product 1", 'amount' => 1000],
	['name' => "Product 2", 'amount' => 500]
]);


$hash = hash_hmac('sha256', implode("", [
    $data['time_to_live_in_seconds'],
    $data['merchant_id'],
    $data['order_id'],
    $data['amount'],
    $data['backend_result_url'],
    $data['merchant_reference_id'],
]), "772dba7e663e70c6bd746a951f88c11460773e656846b9af1d2840c7a2722859");

   $response = Http::accept('application/json')->withOptions(['verify' => false, 'http_errors' => false])->post('https://testpayments.wavemoney.io:8107/payment', [
        	"time_to_live_in_seconds" => $data['time_to_live_in_seconds'],
            "merchant_id" => $data['merchant_id'],
            "order_id" => $data['order_id'],
            "merchant_reference_id" => $data['merchant_reference_id'],
            "frontend_result_url" => $data['frontend_result_url'],
            "backend_result_url" => $data['backend_result_url'],
            "amount" => $data['amount'],
            "payment_description" => $data['payment_description'],
            "merchant_name" => $data['merchant_name'],
            "items" => $items,
            "hash" => $hash
    ]);


    $transactionId = $response->json()['transaction_id'];

    return redirect ("https://testpayments.wavemoney.io:8107/authenticate?transaction_id=$transactionId");

})->name('frontend');


