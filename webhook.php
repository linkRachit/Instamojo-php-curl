<?php
require '../include.php';

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$data = $_POST;
$postdata = json_encode($_POST);
$mac_provided = $data['mac'];  // Get the MAC from the POST data
unset($data['mac']);  // Remove the MAC key from the data.
$ver = explode('.', phpversion());
$major = (int) $ver[0];
$minor = (int) $ver[1];
if($major >= 5 and $minor >= 4){
     ksort($data, SORT_STRING | SORT_FLAG_CASE);
}
else{
     uksort($data, 'strcasecmp');
}

$mac_calculated = hash_hmac("sha1", implode("|", $data), "$salt");
if($mac_provided == $mac_calculated){
    if($data['status'] == "Credit"){
        echo "OK";


        $sql = "SELECT * FROM payment WHERE payment_id='$_GET[payment_id]'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            
            }
        else {

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $requestsite.$_POST['payment_request_id'].'/'.$_POST['payment_id'].'/');
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
            curl_setopt($ch, CURLOPT_HTTPHEADER,
            array($instamojoapikey,$instamojoauthtoken));


            $response = curl_exec($ch);

            curl_close($ch); 


            $json = json_decode($response, true);        

            $statusr = $json['payment_request']['status'];
            $purpose = $json['payment_request']['purpose'];
            $payment_id = $json['payment_request']['payment']['payment_id'];
            $quantity = $json['payment_request']['payment']['quantity'];
            $status = $json['payment_request']['payment']['status'];
            $link_slug = $json['payment_request']['payment']['link_slug'];
            $link_title = $json['payment_request']['payment']['link_title'];
            $buyer_name = $json['payment_request']['payment']['buyer_name'];
            $buyer_phone = $json['payment_request']['payment']['buyer_phone'];
            $buyer_email = $json['payment_request']['payment']['buyer_email'];
            $currency = $json['payment_request']['payment']['currency'];
            $unit_price = $json['payment_request']['payment']['unit_price'];
            $amount = $json['payment_request']['payment']['amount'];
            $fees = $json['payment_request']['payment']['fees'];
            $shipping_address = $json['payment_request']['payment']['shipping_address'];
            $shipping_city = $json['payment_request']['payment']['shipping_city'];
            $shipping_state = $json['payment_request']['payment']['shipping_state'];
            $shipping_zip = $json['payment_request']['payment']['shipping_zip'];
            $shipping_country = $json['payment_request']['payment']['shipping_country'];
            $discount_code = $json['payment_request']['payment']['discount_code'];
            $discount_amount_off = $json['payment_request']['payment']['discount_amount_off'];
            $variants = $json['payment_request']['payment']['variants'];
            $custom_fields = $json['payment_request']['payment']['custom_fields'];
            $affiliate_id = $json['payment_request']['payment']['affiliate_id'];
            $affiliate_commission = $json['payment_request']['payment']['affiliate_commission'];
            $created_at = $json['payment_request']['payment']['created_at'];
            date_default_timezone_set("Asia/Calcutta");
            $dateIndia = date("Y-m-d "."h:i:sa");
            $sql = "INSERT INTO payment ( payment_id, quantity, status, link_slug, link_title, buyer_name, buyer_phone, buyer_email, currency, unit_price, amount, fees, shipping_address, shipping_city, shipping_state, shipping_zip, shipping_country, discount_code, discount_amount_off, affiliate_id, affiliate_commission, created_at) VALUES ( '$payment_id', '$quantity', '$status', '$link_slug', '$link_title', '$buyer_name', '$buyer_phone', '$buyer_email', '$currency', '$unit_price', '$amount', '$fees', '$shipping_address', '$shipping_city', '$shipping_state', '$shipping_zip', '$shipping_country', '$discount_code', '$discount_amount_off', '$affiliate_id', '$affiliate_commission', '$created_at' )";

            $sql = "UPDATE request SET status = '$statusr' WHERE id = '$_GET[payment_request_id]'";    


            date_default_timezone_set($location);
            $dateIndia = date("Y-m-d "."h:i:sa");
            $phpdate = strtotime( $dateIndia );
            $mysqldate = date( 'd-m-Y', $phpdate );


            $to = $buyer_email;
            $subject = "Thank You For your Payment";
                  
            $message = "Thank You For your Payment";
                     
            $header = "From:".$mailsendfrom." \r\n";
            $header .= 'Bcc: '.$bcc1 . "\r\n";
            $header .= "MIME-Version: 1.0\r\n";
            $header .= "Content-type: text/html\r\n";
                     
            $retval = mail ($to,$subject,$message,$header);

            mysqli_close($conn);

        }

    }
    else{
        // Payment was unsuccessful, mark it as failed in your database.
        // You can acess payment_request_id, purpose etc here.
        echo "NOT OK";
    }   
}
else{
    echo "MAC mismatch";
}
?>