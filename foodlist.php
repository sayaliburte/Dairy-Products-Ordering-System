<?php
session_start();

if(!isset($_SESSION['login_user2']))
{
header("location: customerlogin.php"); 
}

?>



<html>

  <head>
    <title> Explore | SHRAVAN DAIRY</title>
	<script>
		function upp(e)
		{
			var str=document.getElementById("search").value;
			var a=String.fromCharCode(e.which);
			var b=a.toUpperCase();
			var str1=str.concat(b);
			e.preventDefault();
			document.getElementById("search").value=str1;
		}
	</script>
  </head>

  <link rel="stylesheet" type = "text/css" href ="css/foodlist.css">
  <link rel="stylesheet" type = "text/css" href ="css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>

  <body>


    <nav class="navbar navbar-inverse navbar-fixed-top navigation-clean-search" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">SHARAVAN DAIRY</a>
        </div>

        <div class="collapse navbar-collapse " id="myNavbar">
          <ul class="nav navbar-nav">
            <li><a href="index.php">Home</a></li>
            <li><a href="aboutus.php">About</a></li>

          </ul>
<?php
if(isset($_SESSION['login_user1'])){

?>



          <ul class="nav navbar-nav navbar-right">
            <li><a href="profile2.php"><span class="glyphicon glyphicon-user"></span> Welcome<?php echo $_SESSION['login_user1']; ?></a></li>
	<li><a href="view_order_details.php">MANAGER CONTROL PANEL</a></li>
            <li><a href="logout_m.php"><span class="glyphicon glyphicon-log-out"></span> Log Out </a></li>
          </ul>

<?php
}
else if (isset($_SESSION['login_user2'])) {
  ?>
           <ul class="nav navbar-nav navbar-right">
            <li><a href="profile.php"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $_SESSION['login_user2']; ?> </a></li>
            <li class="active" ><a href="foodlist.php"><span class="glyphicon glyphicon-cutlery"></span>Product Zone </a></li>
            <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart  (<?php
              if(isset($_SESSION["cart"])){
              $count = count($_SESSION["cart"]); 
              echo "$count"; 
            }
              else
                echo "0";
              ?>) </a></li>
	<li><a href="order.php">Orders </a></li>
            <li><a href="logout_u.php"><span class="glyphicon glyphicon-log-out"></span> Log Out </a></li>
          </ul>
  <?php        
}
else {

  ?>



<ul class="nav navbar-nav navbar-right">
            <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Sign Up <span class="caret"></span> </a>
                <ul class="dropdown-menu">
              <li> <a href="customersignup.php"> User Sign-up</a></li>
            </ul>
            </li>

            <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-log-in"></span> Login <span class="caret"></span></a>
              <ul class="dropdown-menu">
              <li> <a href="customerlogin.php"> User Login</a></li>
            </ul>
            </li>
          </ul>
<?php
}
?>




        </div>

      </div>
    </nav>

    <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">

      <div class="item active">
      <img src="images/img2.jpg" style="width:100%;">
      <div class="carousel-caption">
      </div>
      </div>
       
       <!--div class="item">
      <img src="images/img5.jpg" style="width:100%;">
      <div class="carousel-caption">

      </div>
      </div-->

      <div class="item">
      <img src="images/img7.jpg" style="width:100%;">
      <div class="carousel-caption">

      </div>
      </div>
      <div class="item">
      <img src="images/img1.jpg" style="width:100%;">
      <div class="carousel-caption">
      </div>
      </div>
    
    </div>
   <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
    </div>

<div class="jumbotron">
  <div class="container text-center">
    <h1>Welcome To Shravan Dairy....'</h1>      
    <!--p>Let Products be the solution for your question</p-->
  </div>
</div>

<div class="container" style="margin-top:50px;" >
<form method="GET" action="foodlist.php">
	<div class="input-group">
	<input type="text" class="form-control" placeholder="Search" id="search" name="search" onkeypress="upp(event)">
	<div class="input-group-btn">
	<button class="btn btn-primary" type="submit" id="submit" name="submit"><i class="glyphicon glyphicon-search"></i></button>
	</div>
	</div>
</form>
</div>
<?php
require 'connection.php';
$conn = Connect();
$p_name="5698545123";
if (isset($_GET['submit']))
{
	$p_name= $_GET['search'];
	$query="SELECT * FROM product WHERE locate('".$p_name."',p_name);";
	$result= mysqli_query($conn, $query);
	if (mysqli_num_rows($result) > 0)
	{
  		$count=0;

  		while($row= mysqli_fetch_assoc($result))
		{
    		if ($count == 0)
      			echo "<div class='row'>";
?>
<div class="col-md-3">

<form method="post" action="cart.php?action=add&id=<?php echo $row["p_id"]; ?>">
<div class="mypanel" align="center";>
<img src="<?php echo $row["p_img_src"]; ?>" class="img-responsive">
<h4 class="text-dark"><?php echo $row["p_name"]; ?></h4>
<h5 class="text-danger">&#8377; <?php echo $row["p_rate"]; ?>/-</h5>
<h5 class="text-info">Quantity: <div class="form-group">
  <select class="form-control" id="quantity" name="quantity" style="width:115px;">
 <option value="0.125">125 grams</option>
 <option value="0.25">250 grams</option>
<option value="0.5">500 grams</option>
    <option value="1">1kg</option>
<option value="1.5">1.5kg</option>
  <option value="2">2 kg</option>
<option value="2.5">2.5kg</option>
<option value="3">3 kg</option>

</select>
</div></h5>
<input type="hidden" name="hidden_name" value="<?php echo $row["p_name"]; ?>">
<input type="hidden" name="hidden_price" value="<?php echo $row["p_rate"]; ?>">
<input type="submit" name="add" style="margin-top:5px;" class="btn btn-success" value="Add to Cart">
</div>
</form>
      
     
</div>

<?php
$count++;
if($count==4)
{
  echo "</div>";
  $count=0;
}
}
?>



</div>
</div>
<?php
}
else
{
  ?>

  <div class="container">
      <center>
         <label style="margin-left: 5px;color: red;"> <h1>Oops! Product Not Found</h1> </label>
        <p></p>
      </center>
       
    </div>
  </div>

  <?php

}
}
?>
<div class="container" style="width:95%;">

<!-- Display all Food from food table -->
<?php



$sql = "SELECT * FROM product WHERE NOT locate('".$p_name."',p_name) ORDER BY p_id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0)
{
  $count=0;

  while($row = mysqli_fetch_assoc($result)){
    if ($count == 0)
      echo "<div class='row'>";

?>
<div class="col-md-3">

<form method="post" action="cart.php?action=add&id=<?php echo $row["p_id"]; ?>">
<div class="mypanel" align="center";>
<img src="<?php echo $row["p_img_src"]; ?>" class="img-responsive">
<h4 class="text-dark"><?php echo $row["p_name"]; ?></h4>
<h5 class="text-danger">&#8377; <?php echo $row["p_rate"]; ?>/-</h5>
<h5 class="text-info">Quantity: <div class="form-group">
<?php
	$pid=$row["p_id"];
	if($pid==1 ||$pid==2)
{
?>
	<select class="form-control" id="quantity" name="quantity" style="width:115px;">
	 <option value="0.25">250 ml</option>
	<option value="0.5">500 ml</option>
	<option value="1">1 liters</option>
	<option value="1.5">1.5 liters</option>
	  <option value="2">2 liters</option>	
	<option value="2.5">2.5 liters</option>
	<option value="3">3 liters</option>
	</select>
<?php
}
else
{
?>
  <select class="form-control" id="quantity" name="quantity" style="width:115px;">
 <option value="0.125">125 grams</option>
 <option value="0.25">250 grams</option>
<option value="0.5">500 grams</option>
    <option value="1">1kg</option>
<option value="1.5">1.5kg</option>
  <option value="2">2 kg</option>
<option value="2.5">2.5kg</option>
<option value="3">3 kg</option>

</select>
<?php
}
?>
</div></h5>
<input type="hidden" name="hidden_name" value="<?php echo $row["p_name"]; ?>">
<input type="hidden" name="hidden_price" value="<?php echo $row["p_rate"]; ?>">
<input type="submit" name="add" style="margin-top:5px;" class="btn btn-success" value="Add to Cart">
</div>
</form>
      
     
</div>

<?php
$count++;
if($count==4)
{
  echo "</div>";
  $count=0;
}
}
?>



</div>
</div>
<?php
}
else
{
  ?>

  <div class="container">
    <div class="jumbotron">
      <center>
         <label style="margin-left: 5px;color: red;"> <h1>Oops! No Products is available.</h1> </label>
        <p>Stay Hungry...! :P</p>
      </center>
       
    </div>
  </div>

  <?php

}

?>

   
</body>
</html>