<?php

namespace Laranex\LaravelMyanmarPayments;

use Exception;
use Illuminate\Support\Facades\Http;

class WaveMoney
{

    /**
     * @throws Exception
     */
    public function getPaymentScreenUrl(array $items, string $orderId, int $amount, string $merchantReferenceId, string $backendResultUrl, string $frontendResultUrl = "", string $paymentDescription = ""): string
    {                
        $timeToLiveInSeconds = 300;
        $merchantName = "Pun Hlaing";
        $merchantId = "punhlainghospitalswmmerchant";
        $secretKey = "772dba7e663e70c6bd746a951f88c11460773e656846b9af1d2840c7a2722859";
        $baseUrl = "https://testpayments.wavemoney.io:8107";
        $frontendResultUrl = $frontendResultUrl ? $frontendResultUrl : config("app.url");
        $paymentDescription = $paymentDescription ?$paymentDescription : "Payment for " . config('app.name');


        $this->validateData($items, $amount, $backendResultUrl, $secretKey, $merchantId);

        $items = json_encode($items);
        $hash = hash_hmac("sha256", implode("", [$timeToLiveInSeconds, $merchantId, $orderId, $amount, $backendResultUrl, $merchantReferenceId]), $secretKey);


       // dd($timeToLiveInSeconds, $merchantId, $orderId, $merchantReferenceId, $frontendResultUrl, $backendResultUrl, $amount, $paymentDescription, $merchantName, $items, $hash);

        $response = Http::acceptJson()->withOptions(["verify" => false, "http_errors" => false])
            ->post($baseUrl, [
                "time_to_live_in_seconds" => $timeToLiveInSeconds,
                "merchant_id" => $merchantId,
                "order_id" => $orderId,
                "merchant_reference_id" => $merchantReferenceId,
                "frontend_result_url" => $frontendResultUrl,
                "backend_result_url" => $backendResultUrl,
                "amount" => $amount,
                "payment_description" => $paymentDescription,
                "merchant_name" => $merchantName,
                "items" => $items,
                "hash" => $hash
            ]);


        if ($response->successful()) {
            $transactionId = $response->json()["transaction_id"];
            return "$baseUrl/transaction_id=$transactionId";
        }

        throw new Exception("Something went wrong in requesting payment screen for Wave Money");
    }


    /**
     * @throws Exception
     */
    private function validateData($items, $amount, $backendResultUrl, $secretKey, $merchantId): void
    {

        if (!$secretKey || !$merchantId){
            throw new Exception("Invalid Wave Money Secret Key OR Invalid Wave Merchant Id");
        }

        if ($amount < 0) {
            throw new Exception("Amount cannot be less than 0");
        }

        if (!count($items)) {
            throw new Exception("Invalid items structuressss");
        }

        /**
         *   [
         *      ["name" => "Product 1", "amount" => 100],
         *      ["name" => "Product 2", "amount" => 150]
         *   ]
         */
        foreach ($items as $item) {
  
           info(!array_key_exists("name", $item));
           info(!array_key_exists("amount", $item)); 
           info(!is_string($item["name"])); info(!is_integer($item["amount"])); 
           
           


            if (!array_key_exists("name", $item) || !array_key_exists("amount", $item) || !is_string($item["name"]) || !is_integer($item["amount"])) {
                throw new Exception("Invalid items structure");
            }
        }

        if (!filter_var($backendResultUrl, FILTER_VALIDATE_URL)) {
            throw  new Exception("Invalid backend URL, Be careful, this might lead to wrong data");
        }
    }

}