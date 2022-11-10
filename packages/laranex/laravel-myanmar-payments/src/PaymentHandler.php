<?php

interface PaymentHandler{
    public function getPaymentScreenUrl(string $orderId, int $amount, string $merchantReferenceId, string $backendResultUrl,  string $frontendResultUrl = "", string $paymentDescription = "");
}
