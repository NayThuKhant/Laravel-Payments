<?php



/*
 * You can place your custom package configuration in here.
 */
return [
    "wave_money" => [
        "base_url" => env("WAVE_MONEY_BASE_URL", "https://testpayments.wavemoney.io:8107"),
        "time_to_live_in_seconds" => env("WAVE_MONEY_TIME_TO_LIVE_IN_SECONDS", 300),
        "merchant_name" => env("WAVE_MONEY_MERCHANT_NAME", "LARAVEL"),
        "merchant_id" => env("WAVE_MONEY_MERCHANT_ID", "punhlainghospitalswmmerchant"),
        "secret_key" => env("WAVE_MONEY_SECRET_KEY", "772dba7e663e70c6bd746a951f88c11460773e656846b9af1d2840c7a2722859")
    ]
];
