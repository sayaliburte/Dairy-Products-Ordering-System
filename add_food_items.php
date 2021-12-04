<?php
include('session_m.php');

if(!isset($login_session)){
header('Location: managerlogin.php'); 
}

?>
<!DOCTYPE html>
<html>

  <head>
    <title> Manager Login | SHRAVAN DAIRY </title>
  </head>

  <link rel="stylesheet" type = "text/css" href ="css/add_food_items.css">
  <link rel="stylesheet" type = "text/css" href ="css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script>
	function check(e)
	{
		var ch=String.fromCharCode(e.which);
    		if(!(/[0-9]/.test(ch)))
    		{
        			e.preventDefault();
  	 	}
		if(e.keyCode == 32)
		{
       	 		e.preventDefault();	
    		}
	}
	</script>
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
          <a class="navbar-brand" href="index.php">SHRAVAN DAIRY</a>
        </div>

        <div class="collapse navbar-collapse " id="myNavbar">
          <ul class="nav navbar-nav">
            <li><a href="index.php">Home</a></li>
            <li><a href="aboutus.php">About</a></li>
          </ul>

          <ul class="nav navbar-nav navbar-right">
            <li><a href="profile2.php"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $login_session; ?> </a></li>
            <li class="active"> <a href="managerlogin.php">MANAGER CONTROL PANEL</a></li>
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
    		<a href="view_order_details.php" class="list-group-item ">View Order Details</a>
		<a href="view_food_items.php" class="list-group-item ">View Product</a>
    		<a href="add_food_items.php" class="list-group-item active">Add Product</a>
    		<a href="edit_food_items.php" class="list-group-item ">Edit Product</a>
    		<a href="delete_food_items.php" class="list-group-item ">Delete Product</a>
    	</div>
    </div>
    


    
    <div class="col-xs-9">
      <div class="form-area" style="padding: 0px 100px 100px 100px;">
        <form action="add_food_items1.php" method="POST" autocomplete="off">
        <br style="clear: both">
          <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;"> ADD NEW PRODUCT HERE </h3>

          <div class="form-group">
            <input type="text" class="form-control" id="p_name" name="p_name" placeholder="Your Product name" required="">
          </div>     

          <div class="form-group">
            <input type="text" class="form-control" id="p_rate" name="p_rate" placeholder="Your Product Price (INR)" required="" onkeypress="check(event)" >
          </div>

          <div class="form-group">
            <input type="text" class="form-control" id="p_description" name="p_description" placeholder="Your Product Description" required="">
          </div>

          <div class="form-group">
            <input type="text" class="form-control" id="p_img_src" name="p_img_src" placeholder="Your Product Image Path [images/<filename>.<extention>]" required="">
          </div>

          <div class="form-group">
          <button type="submit" id="submit" name="submit" class="btn btn-primary pull-right"> ADD PRODUCT </button>    
      </div>
        </form>

        
        </div>
      
    </div>
</div>

  </body>
</html>