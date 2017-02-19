<?php
ob_start();
include 'include.php';

if (isset($_GET['payment_id']) && isset($_GET['payment_request_id']))
{

  
{
    ob_end_clean();
}


}

else
{
    $url = "form";
    header( "Location: $url" );
    {
    ob_end_clean();
}

    
}


?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <title>Success</title>   
</head>

    <body>
       
  <strong>Thank You!</strong> Your Payment has been successfully done.
</div>

</body></html>

