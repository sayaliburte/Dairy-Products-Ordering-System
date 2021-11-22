<?php
session_start();

if(!isset($_SESSION['login_user2']))
{
header("location: customerlogin.php"); 
}

?>



<html>

  <head>
    <title> Explore | SHRAVAN DAIRY </title>
  </head>

  <link rel="stylesheet" type = "text/css" href ="css/foodlist2.css">
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
            <li><a href="foodlist.php"><span class="glyphicon glyphicon-cutlery"></span>Product Zone </a></li>
            <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart  (<?php
              if(isset($_SESSION["cart"])){
              $count = count($_SESSION["cart"]); 
              echo "$count"; 
            }
              else
                echo "0";
              ?>) </a></li>
	<li class="active"><a href="order.php"><span class="glyphicon glyphicon-cutlery"></span>Orders</a></li>
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
              <li> <a href="managerlogin.php">Manager Login</a></li>
            </ul>
            </li>
          </ul>
<?php
}
?>

        </div>

      </div>
    </nav>



<div class="jumbotron">
  <div class="container text-center">
    <h1>Your Order List....'</h1>      
    <!--p>Let Product be solution to your question</p-->
  </div>
</div>


<div class="container" style="width:95%;">

<!-- Display all Food from food table -->
<?php

require 'connection.php';
$conn = Connect();
$user=$_SESSION["login_user2"];
$sql = "SELECT DISTINCT(order_id),o_date,total FROM order_short WHERE cust_username='".$user."' ORDER BY o_date";

$result=$conn->query($sql);
if(mysqli_num_rows($result) > 0)
{
  $count=0;

  while($row = mysqli_fetch_array($result))
	{
    		if ($count == 0)
      		echo "<div class='row'>";
		$sql1="SELECT DISTINCT(order_id),p_name,quantity,amt from order_details,product WHERE product.p_id=order_details.p_id AND order_id='".$row["order_id"]."';";
		$result1=$conn->query($sql1);
		$num=mysqli_num_rows($result1);
?>
<div class="table-responsive" style="padding-left:50px; padding-right:50px;">
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
	?><div class="col-md-12 line">
	<h4 class="text-info"><?php echo "ORDER ID: SH00".$row["order_id"];?></h5></div>
	<h4 class="text-info"><?php echo "ORDER DATE: ".$row["o_date"];?></h5>
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
		<td><?php echo $row2["amt"]."&#8377";?></td></tr></div><?php
	}?>
<h4 class="text-danger"><?php echo "TOTAL:".$row["total"];?>&#8377</h5>
<?php
}
?>
</div>
<?php
}
  ?>
</body>
</html>