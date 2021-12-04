<html>
<head>
</head>
  <link rel="stylesheet" type = "text/css" href ="css/foodlist.css">
  <link rel="stylesheet" type = "text/css" href ="css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
<body>
<div class="container" style="width:95%;">
<div class="row">
<div class="col-md-3">

<form method="post" action="cart.php?action=add&id=<?php echo $row["p_id"]; ?>">
<div class="mypanel" align="center";>
<img src="images/img2.jpg" class="img-responsive">
<h4 class="text-dark">COW MILK</h4>
<h5 class="text-danger">&#8377; 55/-</h5>
<h5 class="text-info">Quantity: <div class="form-group">
  <select class="form-control" id="quantity" name="quantity" style="width:115px;">
 <option value="0.25">250 ml</option>
<option value="0.5">500 ml</option>
<option value="1">1 liters</option>
<option value="1.5">1.5 liters</option>
  <option value="2">2 liters</option>
<option value="2.5">2.5 liters</option>
<option value="3">3 liters</option>

</select>
</div></h5>
<input type="hidden" name="hidden_name" value="<?php echo $row["p_name"]; ?>">
<input type="hidden" name="hidden_price" value="<?php echo $row["p_rate"]; ?>">
<input type="submit" name="add" style="margin-top:5px;" class="btn btn-success" value="Add to Cart">
</div>
</form>
</body>
</html>