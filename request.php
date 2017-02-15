<?php
ob_start();
session_start();

require 'include.php';


if($_POST['amount'] >=9) {


$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "INSERT INTO fill_form ( name, email, phone, address, amount)
VALUES ('$_POST[name]', '$_POST[email]', '$_POST[phone]', '$_POST[address]', '$_POST[amount]')";


if (mysqli_query($conn, $sql)) {
   
} else {
  
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $requestsite);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER,
            array($instamojoapikey,
                  $instamojoauthtoken));

$payload = Array(
    'purpose' => "payment",
    'amount' => $_POST['amount'],
    'phone' => $_POST['phone'],
    'buyer_name' => $_POST['name'],
    'redirect_url' => $redirect_url,
    'send_email' => false,
    'webhook' => $webhook,
    'send_sms' => false,
    'email' => $_POST['email'],
    'allow_repeated_payments' => false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
$response = curl_exec($ch);

curl_close($ch);
   


$json = json_decode($response, true);
$url = $json['payment_request']['longurl'];
$_SESSION['amount'] = $json['payment_request']['amount'];
$_SESSION['phone'] = $json['payment_request']['phone'];
$_SESSION['buyer_name'] = $json['payment_request']['buyer_name'];
$_SESSION['email']= $json['payment_request']['email'];

$ida = $json['payment_request']['id'];
$phonea = $json['payment_request']['phone'];
$emaila = $json['payment_request']['email'];
$buyer_namea = $json['payment_request']['buyer_name'];
$amounta = $json['payment_request']['amount'];
$purposea = $json['payment_request']['purpose'];
$statusa = $json['payment_request']['status'];
$send_smsa = $json['payment_request']['send_sms'];
$send_emaila = $json['payment_request']['send_email'];
$sms_statusa = $json['payment_request']['sms_status'];
$email_statusa = $json['payment_request']['email_status'];
$longurla = $json['payment_request']['longurl'];
$redirect_urla = $json['payment_request']['redirect_url'];
$webhooka = $json['payment_request']['webhook'];
$created_ata = $json['payment_request']['created_at'];
$modified_ata = $json['payment_request']['modified_at'];

$sql = "INSERT INTO request ( id, phone, email, buyer_name, amount, purpose, status, send_sms, send_email, sms_status, email_status, longurl, redirect_url, webhook, created_at, modified_at ) VALUES ( '$ida', '$phonea', '$emaila', '$buyer_namea', '$amounta', '$purposea', '$statusa', '$send_smsa', '$send_emaila', '$sms_statusa', '$email_statusa', '$longurla', '$redirect_urla', '$webhooka', '$created_ata', '$modified_ata' )";

if (mysqli_query($conn, $sql)) {
   
} else {
    
}


$url = $json['payment_request']['longurl']; 

header( "Location: $url" );
while (ob_get_status()) 
{
    ob_end_clean();
}

}
else {
  
    $url = "form";
    header( "Location: $url" );
    while (ob_get_status()) 
{
    ob_end_clean();
}
}
mysqli_close($conn);



?>


