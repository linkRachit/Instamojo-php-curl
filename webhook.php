<?php
require '../include.php';

$data = $_POST;
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
        $phpdate = strtotime( $dateIndia );
        $mysqldate = date( 'd-m-Y', $phpdate );


        $to = $buyer_email;
        $subject = 'Thank You For your Payment';
              
        $message = "Thank You For your Payment";
                 
        $header = "From:".$mailsendfrom." \r\n";
        $header .= 'Bcc: XXXXXXXX@XXX.XXX' . "\r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html\r\n";
                 
        $retval = mail ($to,$subject,$message,$header);

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