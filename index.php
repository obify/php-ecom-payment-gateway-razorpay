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
<?php 
$sql="select * from courses";
$result=mysqli_query($conn,$sql);

while($data=mysqli_fetch_array($result))
{?>
<div class="col-xl-4">
  <div class="card" style="width:400px">
    <img class="card-img-top" src="uploads/<?php echo $data['image'];?>" alt="Card image" style="width:100%">
    <div class="card-body">
      <input type="hidden" id="courseId" value="<?php echo $data['id'];?>" />
      <h4 class="card-title"><?php echo $data['name'];?></h4>
      <p class="card-text">Rs <?php echo $data['price'];?></p>
      <a href="<?php echo $base_url;?>/personal-details.php?id=<?php echo $data['id'];?>" class="btn btn-primary proceed">Proceed</a>
    </div>
  </div>
</div>
<?php } ?>

</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

</body>
</html>
