<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Wave Merchant Integration</title>
</head>
<body>
    <form action="https://testpayments.wavemoney.io:8107/payment" method="POST">
        <input type="hidden" name="time_to_live_in_seconds" value="1000">
        <input type="hidden" name="merchant_id" value="punhlainghospitalswmmerchant">
        <input type="hidden" name="order_id" value="123456">
        <input type="hidden" name="merchant_reference_id" value="123456">
        <input type="hidden" name="frontend_result_url" value="https://laravelpackageboilerplate.com/">
        <input type="hidden" name="backend_result_url" value="https://laravelpackageboilerplate.com/">
        <input type="hidden" name="amount" value="5000">
        <input type="hidden" name="payment_description" value="test">
        <input type="hidden" name="merchant_name" value="Test">
        <input type="hidden" name="items" value='hellwoorld'>
        <input type="hidden" name="hash" value="hellwoorld">
        <button class="btn btn-primary">Pay with Wave</button>
    </form>
</body>
</html>