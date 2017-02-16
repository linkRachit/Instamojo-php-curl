# Instamojo-php-curl

This project is the basic integration of Instamojo API through curl.

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

