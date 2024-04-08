<?php 
include('connection.php');
include('config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Courses</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container mt-3">
<div class="row">
    <h2 class="text-center mb-5">Enter your details</h2>
<?php 
$course_id = $_GET["id"];
$sql="select * from courses where id = ".$course_id;
$result=mysqli_query($conn,$sql);

while($data=mysqli_fetch_array($result))
{?>
        <div class="col-md-4">
          <div class="card" >
            <img class="card-img-top" src="uploads/<?php echo $data['image'];?>" alt="Card image" style="width:100%">
            <div class="card-body">
              <h4 class="card-title"><?php echo $data['name'];?></h4>
              <p class="card-text">Rs <?php echo $data['price'];?></p>
            </div>
          </div>
        </div>
        <div class="col-md-8">
        <form required>
          <div class="mb-3">
            <label for="custName" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="custName">
          </div>
          <div class="mb-3">
            <label for="custEmail" class="form-label">Email address</label>
            <input type="email" class="form-control" id="custEmail" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
          </div>
          <div class="mb-3">
            <label for="custPhone" class="form-label">Phone number</label>
            <input type="text" class="form-control" id="custPhone" aria-describedby="custPhoneHelp">
            <div id="custPhoneHelp" class="form-text">We'll never share your phone number with anyone else.</div>
          </div>
          <div class="mb-3">
            <label for="custAddress" class="form-label">Full address</label>
            <textarea class="form-control" id="custAddress"></textarea>
          </div>
          <a href="javascript:void(0)" data-productid="<?php echo $data['id'];?>" data-productname="<?php echo $data['name'];?>" data-amount="<?php echo $data['price'];?>" class="btn btn-primary proceed-to-payment">Proceed to Payment</a>
        </form>
        </div>
<?php } ?>

</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>

$(".proceed-to-payment").click(function()
{
  if(!$("#custName").val()){
  alert("Please enter a valid name");
  return false;
}
if(!$("#custEmail").val()){
  alert("Please enter a valid email");
  return false;
}
if(!$("#custPhone").val()){
  alert("Please enter a valid phone");
  return false;
}
if(!$("#custAddress").val()){
  alert("Please enter a valid address");
  return false;
}
var amount=$(this).attr('data-amount');	
var productid=$(this).attr('data-productid');	
var productname=$(this).attr('data-productname');	
var customerName=$("#custName").val();	

var options = {
    "key": "rzp_test_c9TEng0ws6BMLC", // Enter the Key ID generated from the Dashboard
    "amount": amount*100, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
    "name": "RP TEST APP",
    "description": productname,
    "image": "https://img-c.udemycdn.com/user/200_H/145600796_0bec.jpg",
    "handler": function (response){
        var paymentid=response.razorpay_payment_id;
		
		$.ajax({
			url:"payment-process.php",
			type:"POST",
			data:{product_id:productid,payment_id:paymentid,product_name:productname,customer_name:customerName},
			success:function(finalresponse)
			{
				if(finalresponse=='done')
				{
					window.location.href="http://localhost/myapps/razorpay-payment-gateway-in-php/success.php";
				}
				else 
				{
					alert('Please check console.log to find error');
					console.log(finalresponse);
				}
			}
		})
        
    },
    "theme": {
        "color": "#3399cc"
    }
};
var rzp1 = new Razorpay(options);
 rzp1.open();
 e.preventDefault();
});
</script>
</body>
</html>
