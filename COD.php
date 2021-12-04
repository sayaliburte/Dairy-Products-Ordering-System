<?php
session_start();
require 'connection.php';
$conn = Connect();
if(!isset($_SESSION['login_user2'])){
header("location: customerlogin.php"); 
}
?>



<html>

  <head>
    <title> Cart | SHRAVAN DAIRY</title>
  </head>

  <link rel="stylesheet" type = "text/css" href ="css/back.css">
  <link rel="stylesheet" type = "text/css" href ="css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>

  <body>

  
       </script>

    <nav class="navbar navbar-inverse navbar-fixed-top navigation-clean-search" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">SHRAVAN DAIRY</a>
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
            <li><a href="profile2.php"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $_SESSION['login_user1']; ?> </a></li>
            <li><a href="view_order_details.php">MANAGER CONTROL PANEL</a></li>
            <li><a href="logout_m.php"><span class="glyphicon glyphicon-log-out"></span> Log Out </a></li>
          </ul>
<?php
}
else if (isset($_SESSION['login_user2'])) {
  ?>
           <ul class="nav navbar-nav navbar-right">
            <li><a href="profile.php"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $_SESSION['login_user2']; ?> </a></li>
            <li><a href="foodlist.php"><span class="glyphicon glyphicon-cutlery"></span>Product Zone </a></li>
            <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart
             (<?php
              if(isset($_SESSION["cart"])){
              $count = count($_SESSION["cart"]); 
              echo "$count"; 
            }
              else
                echo "0";
              ?>)
              </a></li>
		<li><a href="order.php">Orders</a></li>
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
              <li> <a href="managerlogin.php"> Manager Login</a></li>
            </ul>
            </li>
          </ul>

<?php
}
?>


        </div>

      </div>
    </nav>



        <div class="container">
          <div class="jumbotron">
            <h1 class="text-center" style="color: green;"><span class="glyphicon glyphicon-ok-circle"></span> Order Placed Successfully.</h1>
          </div>
        </div>
        <br>
<?php
$conn= Connect();
$gtotal = 0;
  foreach($_SESSION["cart"] as $keys => $values)
  {
    $quantity = $values["food_quantity"];
    $price =  $values["food_price"];
    $total = ($values["food_quantity"] * $values["food_price"]);
    $gtotal = $gtotal + $total;
}
	$query="SELECT COUNT(order_id) FROM order_short;";
	$result=$conn->query($query);
	$row=mysqli_fetch_array($result);
	$order=$row[0]+1;
	 $username = $_SESSION["login_user2"];
	$query1="SELECT cust_address FROM `customer` WHERE cust_username='".$username."' LIMIT 1;";
	$result1=$conn->query($query1);
	if(!isset($_SESSION['address']) || $_SESSION['address']=="")
	{
		while($row1=mysqli_fetch_array($result1))
		{
			$add=$row1["cust_address"];
		}	
	}
	else
	{
		$add= $_SESSION['address'];
	}
  foreach($_SESSION["cart"] as $keys => $values)
  {

    $p_id = $values["food_id"];
    $quantity = $values["food_quantity"];
    $price =  $values["food_price"];
    $total = ($values["food_quantity"] * $values["food_price"]);
    $username = $_SESSION["login_user2"];
    $order_date = date('Y-m-d');
	if($keys==0)
	{
		$query3="INSERT INTO `order_short` (`order_id`, `cust_username`, `delivery_address`, `o_date`, `total`) VALUES ('".$order."', '".$username."', '".$add."', '".$order_date."', '".$gtotal."' );";
		  $success1= $conn->query($query3);
	}      
	$query4="INSERT INTO `order_details` (`order_id`, `p_id`, `quantity`, `amt`) VALUES ('".$order."', '".$p_id."', '".$quantity."', '".$total."');";	
	$success2= $conn->query($query4);
}
      if(!$success1|| !$success2)
      {
        ?>
        <div class="container">
          <div class="jumbotron">
            <h1>Something went wrong!</h1>
            <p>Try again later.</p>
          </div>
        </div>

        <?php
      }
   else
{   
?>

<h2 class="text-center"> Thank you for Ordering at SHRAVAN DAIRY'! The ordering process is now complete.</h2>
<div class="container" style="width:95%;" >
<?php
}
unset($_SESSION["cart"]);
unset($_SESSION["address"]);
?>

<div class="container" style="width:95%;" >
<!-- Display all Food from food table -->
<?php
$sql = "SELECT order_id,cust_name,o_date,total,delivery_address,cust_phoneno FROM order_short,customer WHERE customer.cust_username=order_short.cust_username AND order_id='".$order."'";

$result=$conn->query($sql);
if(mysqli_num_rows($result) > 0)
{
  $count=0;

  while($row = mysqli_fetch_array($result))
	{?>
		<div style="clear: both">
    		<h4 class="text-warning"><?php echo "ORDER ID: SH00".$row["order_id"];?></h5>
		<h4 class="text-warning"><?php echo "ORDER DATE: ".$row["o_date"];?></h4></div>
		<h4 class="text-warning"><?php echo "Name: ".$row["cust_name"];?></h4>
		<h4 class="text-warning"><?php echo "CONTACT: ".$row["cust_phoneno"];?></h4>
		<h4 class="text-warning"><?php echo "DELIVERY ADDRESS: ".$row["delivery_address"];?></h4>	
		<?php
		$total=$row["total"];
	}
}
		$sql1="SELECT order_id,p_name,quantity,amt FROM order_details,product WHERE product.p_id=order_details.p_id AND order_id='".$order."';";
		$result1=$conn->query($sql1);
		$num=mysqli_num_rows($result1);
?>
<div class="table-responsive" style="padding-left:100px; padding-right:100px;">
<table class="table table-striped">
<thead class="thead-dark">
<tr>
<th width="35%">PRODUCT NAME</th>
<th width="10%">QUANTITY</th>
<th width="10%">PRICE</th>
</tr>
</thead>
<tr rowspan="<?php echo $num;?>">
<?php
	while($row2=mysqli_fetch_array($result1))
	{
		?>	
		<td><?php echo $row2["p_name"];?></td>
		<?php
			if($row2["p_name"]=="COW MILK" ||$row2["p_name"]=="BUFFALO MILK")
			{
		?>
		<td><?php echo $row2["quantity"]."LI";?></td>
		<?php
		}
		else
		{
		?>	
		<td><?php echo $row2["quantity"]."KG";?></td>
		<?php
		}
		?>
		<td><?php echo $row2["amt"]."&#8377";?></td></tr><?php

	}?>
<tr>
<td class="text-danger">Grand Total</td>
<td align="right">&#8377; <?php echo number_format($total, 2); ?></td>
</tr>
</table></div>
</div>
<button onclick="window.print()" class="btn btn-success form-control">Print</button>
        </body>

</html>