<!DOCTYPE html>
<html lang="en">
<head>
  <title>Form</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<script type="text/javascript">
function validateMyForm()
{
  if($('#amount').val()<9)
  { 
    alert("Amount must be equal to or greater than 9");
    //returnToPreviousPage();
    return false;
  }
  if($('#phone').val().length!=10)
  { 
    alert("Check Phone Number");
    //returnToPreviousPage();
    return false;
  }
  var flag=$('#email').val().match("[A-z0-9_\-]+[@][A-z0-9_\-]+[\.]{1,1}[A-z]{2,4}");
  if(flag)
  {
    return true;
  }
  else
  {
    alert("Check Email Address");
    //returnToPreviousPage();
    return false;
  }
  

  //alert("validations passed");
  return true;
}
</script>
<body>

<div class="container">
  <h2>Form</h2>
  <form class="form-horizontal" action="request.php" method="POST" onsubmit="return validateMyForm();">
  <div class="form-group">
    <input type="number" class="form-control amount" id="amount" name="amount" placeholder="Click on the Donation Amount*" required><!--value=""-->
  </div>
  <div class="form-group">
    <input type="text" class="form-control" id="name" name="name" placeholder="Name*" required>
  </div>
  <div class="form-group">
      <input type="number" class="form-control" id="phone" name="phone" placeholder="Mobile Number*" required>
  </div>
  <div class="form-group">
    <input type="email" class="form-control" id="email" name="email" placeholder="Email ID*" required>
  </div>
  <div class="form-group">
    <input type="text" class="form-control" id="address" name="address" placeholder="Mailing Address*" required>
  </div>
  <div class="centered">
  <button type="submit" class="btn btn-default btn-donate">PAY NOW</button></div>
    
  </form>
</div>
</body>
</html>