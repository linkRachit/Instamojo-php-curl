# Instamojo-php-curl

This project is the basic integration of Instamojo API through curl with confirmation mail on successful payment with database update through webhook.

##Setup

Signing up will create your API key and Auth token. You will need these to create requests.
Base URL: https://www.instamojo.com/api/1.1/payment-requests/

Note: If you have signed up on our sandbox environment at https://test.instamojo.com/, the URL needs to be changed to https://test.instamojo.com/api/1.1/ ; The examples use our production URL.This Sample of a web server written in Node.js to setup/start project in raw Node.js.

Update include.php file

For Normal Account

```console

  $requestsite = "https://www.instamojo.com/api/1.1/payment-requests/";

```
For Sandbox Account

```console

  $requestsite = "https://test.instamojo.com/api/1.1/payment-requests/";

```

Also update other variable according to your preferences 

Upload final.sql file on phpMyAdmin.


## Create a Request

```console

  <?php

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_HTTPHEADER,
                array("X-Api-Key:XXXX",
                      "X-Auth-Token:XXXX"));
    $payload = Array(
        'purpose' => 'XXXX',
        'amount' => 'XXXX',
        'phone' => 'XXXX',
        'buyer_name' => 'XXXX',
        'redirect_url' => 'http://XXXX/success',
        'send_email' => true,
        'webhook' => 'http://XXXX/webhook',
        'send_sms' => true,
        'email' => 'XXXX@XXXX.XXXX',
        'allow_repeated_payments' => false
    );
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
    $response = curl_exec($ch);
    curl_close($ch); 

    echo $response;

  ?>

```

## Get Payment Details

```console

  <?php

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://www.instamojo.com/api/1.1/payment-requests/<payment-request-id>/<payment-id>/');
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_HTTPHEADER,
                array("X-Api-Key:XXXX",
                      "X-Auth-Token:XXXX"));
    $payload = Array(
        'purpose' => 'XXXX',
        'amount' => 'XXXX',
        'phone' => 'XXXX',
        'buyer_name' => 'XXXX',
        'redirect_url' => 'http://XXXX/Success',
        'send_email' => true,
        'webhook' => 'http://XXXX/webhook',
        'send_sms' => true,
        'email' => 'XXXX@XXXX.XXXX',
        'allow_repeated_payments' => false
    );
    $response = curl_exec($ch);
    curl_close($ch); 

    echo $response;

  ?>

```

## Test/Sandbox Account

You can create an account on https://test.instamojo.com

For payments use the following card details:

```console

    Number: 4242 4242 4242 4242

    Date: Any valid future date

    CVV: 111

    Name: abc

    3D-secure password: 1221

```    

note- You do not have to submit documents or go through the onboarding flow when you create a test account.