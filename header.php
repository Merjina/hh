<html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
  <div class="container-fluid p-3 bg-warning">
    <h2 style="font-size:50px;font-weight:bold" class="text-important">HAppY FAmilY
    <img src="./image/happy.jpg" class="rounded-circle" width="90" height="80"> 
    </h2>
<br>
    <div class="d-flex justify-content-between ">
      <?php
      $count=0;
      if(isset($_SESSION['shopping_cart'])){
        $count=count($_SESSION['shopping_cart']);
      }
      ?>
        <a href="index.php"class="btn btn-info  p-2 ">Home</a>
        <a href="mycart.php"class="btn btn-success p-2">My cart (<?php echo $count; ?>) </a>
    </div>
  </div>
</body>
</html>