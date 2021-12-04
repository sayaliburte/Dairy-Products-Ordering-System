<?php
include('session_m.php');

if(!isset($login_session)){
header('Location: managerlogin.php'); 
}

?>
<!DOCTYPE html>
<html>

  <head>
    <title> Manager Login | SHRAVAN DAIRY</title>
  </head>
  <link rel="stylesheet" type = "text/css" href ="css/line.css">
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

          <ul class="nav navbar-nav navbar-right">
            <li><a href="profile2.php"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $login_session; ?> </a></li>
            <li class="active"> <a href="view_order_details.php">MANAGER CONTROL PANEL</a></li>
            <li><a href="logout_m.php"><span class="glyphicon glyphicon-log-out"></span> Log Out </a></li>
          </ul>
        </div>

      </div>
    </nav>




<div class="container">
    <div class="jumbotron">
     <h1>Hello Manager! </h1>
     <p>Manage all your Dairy from here</p>

    </div>
    </div>

<div class="container">
    <div class="container">
    	<div class="col">
    		
    	</div>
    </div>

    
    	<div class="col-xs-3" style="text-align: center;">

    	<div class="list-group">
    		<a href="view_order_details.php" class="list-group-item active">View Order Details</a>
    	
    		<a href="view_food_items.php" class="list-group-item">View Products</a>
    		<a href="add_food_items.php" class="list-group-item ">Add Products</a>
    		<a href="edit_food_items.php" class="list-group-item ">Edit Products</a>
    		<a href="delete_food_items.php" class="list-group-item ">Delete Products</a>
        </div>
    </div>
    


    
    <div class="col-xs-9">
      <div class="form-area" style="padding: 0px 100px 100px 100px;">
        
        <br style="clear: both">
	
          <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;"> YOUR PRODUCT ORDER LIST </h3>


<div class="container" style="width:95%;" >
<!-- Display all Food from food table -->
<?php




$sql = "SELECT DISTINCT(order_id),cust_name,o_date,total,delivery_address,cust_phoneno FROM order_short,customer WHERE customer.cust_username=order_short.cust_username ORDER BY order_id DESC";

$result=$conn->query($sql);
if(mysqli_num_rows($result) > 0)
{
  $count=0;

  while($row = mysqli_fetch_array($result))
	{
    		if ($count == 0)
      		echo "<div class='row'>";
		$sql1="SELECT DISTINCT(order_id),p_name,quantity,amt FROM order_details,product WHERE product.p_id=order_details.p_id AND order_id='".$row["order_id"]."';";
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
	<h4 class="text-info"><?php echo "ORDER DATE: ".$row["o_date"];?></h4>
	<h4 class="text-info"><?php echo "CUSTOMER: ".$row["cust_name"];?></h4>
	<h4 class="text-info"><?php echo "CONTACT: ".$row["cust_phoneno"];?></h4>
	<h4 class="text-info"><?php echo "DELIVERY ADDRESS: ".$row["delivery_address"];?></h4>
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
<h4 class="text-danger"><?php echo " GRAND TOTAL:".$row["total"];?>&#8377</h5>
<?php
}
?>
</div>
<?php
}
  ?>
</div>  
</div>
</div>
  </body>
</html>