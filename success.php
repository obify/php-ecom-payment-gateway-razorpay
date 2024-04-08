<?php 
include('config.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Success</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container mt-3">
  <h2>Payment has been successful</h2>
  <div class="alert alert-success">
    <strong>Congratulations <?php echo $_SESSION['customerName'];?><br> 
    Your Order for Product </strong><?php echo $_SESSION['productname'];?> 
    <strong>has been successfully placed! <br> Please check your email for details.</strong>
    <strong>Please note your payment id: </strong><?php echo $_SESSION['paymentid'];?> 
  </div>
  <a href="<?php echo $base_url;?>">Browse Products</a>
</div>

</body>
</html>
