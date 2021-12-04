<?php
session_start();
require"connection.php";
if(!isset($_SESSION['login_user1']))
{
header("location: managerlogin.php"); 
}

?>
<html>
<head>
    <title> Manager Profile | SHRAVAN DAIRY </title>
  </head>

  <link rel="stylesheet" type = "text/css" href ="css/managersignup.css">
  <link rel="stylesheet" type = "text/css" href ="css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script>
			function disp(e)
			{
				alert("Profile Updated Successfully");
			}
			function checknum(e)
			{
				var ch=String.fromCharCode(e.which);
    				if((/[0-9]/.test(ch)))
    				{
        					e.preventDefault();
    				}
			}
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
			function checkspace(e)
			{
				var ch=String.fromCharCode(e.which);
				if(e.keyCode == 32)
				{
       	 				e.preventDefault();	
    				}
			}
			function mob()
			{
				var mob=document.getElementById("contact").value;
				if(mob.length!=10)
				{
					alert("Mobile Number must have size 10 Please Check it!!");
					return false;
				}
				return true;
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
            <li class="active"><a href="profile2.php"><span class="glyphicon glyphicon-user"></span> Welcome<?php echo $_SESSION['login_user1']; ?></a></li>
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
	<li><a href="order.php">Orders </a></li>
            <li><a href="logout_u.php"><span class="glyphicon glyphicon-log-out"></span> Log Out </a></li>
          </ul>
  <?php        
}
else {
  ?>

<?php
}
?>
        </div>

      </div>
    </nav>
<?php
$conn= Connect();
$user=$_SESSION['login_user1'];
	 if (isset($_GET['submit']))
	{
	    $username = $_GET['admin_username'];
	    $name = $_GET['admin_name'];
	    $add = $_GET['admin_address'];
	    $number = $_GET['admin_phoneno'];
	$pass=$_GET['admin_password'];
	    $query = mysqli_query($conn, "UPDATE admin set admin_username='$username', admin_name='$name', admin_address='$add', admin_phoneno='$number', admin_password='$pass' WHERE admin_username='$user'"); 
	    $_SESSION['login_user1']=$username;
	$user=$username;
    	}
	$query="SELECT * FROM admin where admin_username='".$user."' LIMIT 1;";
	$result=$conn->query($query);
	while($row= mysqli_fetch_array($result)) 
	{
?>
    <div class="container">
    <div class="jumbotron">
     <h1>Hi Manager, You Can Edit Your Profile Here</h1>
     <br>
    </div>
    </div>


    <div class="container" style="margin-top: 4%; margin-bottom: 2%;">
      <div class="col-md-5 col-md-offset-4">
      <div class="panel panel-primary">
        <div class="panel-heading"> Edit Profile </div>
        <div class="panel-body">
          
        <form role="form" action="profile2.php" method="GET" autocomplete="off">
         
          <div class="row">
          <div class="form-group col-xs-12">
            <label for="fullname"><span class="text-danger" style="margin-right: 5px;">*</span> Full Name: </label>
            <div class="input-group">
              <input class="form-control" id="admin_name" type="text" name="admin_name" onkeypress="checknum(event)" placeholder="Your Full Name" value="<?php echo $row['admin_name'];?>" required="" autofocus="">
              <span class="input-group-btn">
                <label class="btn btn-primary"><span class="glyphicon glyphicon-user" aria-hidden="true"></label>
            </span>
              </span>
            </div>           
          </div>
        </div>

        <div class="row">
          <div class="form-group col-xs-12">
            <label for="username"><span class="text-danger" style="margin-right: 5px;">*</span> Username: </label>
            <div class="input-group">
              <input class="form-control" id="admin_username" type="text" name="admin_username" onkeypress="checkspace(event)"  value="<?php echo $row['admin_username'];?>" placeholder="Your Username " required="">
              <span class="input-group-btn">
                <label class="btn btn-primary"><span class="glyphicon glyphicon-user" aria-hidden="true"></label>
            </span>
              </span>
            </div>           
          </div>
        </div>

<div class="row">
          <div class="form-group col-xs-12">
            <label for="address"><span class="text-danger" style="margin-right: 5px;">*</span> Address: </label>
            <div class="input-group">
              <input class="form-control" id="admin_address" type="text" name="admin_address" placeholder=" Full Address"  value="<?php echo $row['admin_address'];?>"required="">
              <span class="input-group-btn">
                <label class="btn btn-primary"><span class="glyphicon glyphicon-home" aria-hidden="true"></label>
            </span>
              </span>
            </div>           
          </div>
        </div>

 <div class="row">
          <div class="form-group col-xs-12">
            <label for="contact"><span class="text-danger" style="margin-right: 5px;">*</span> Contact: </label>
            <div class="input-group">
              <input class="form-control" id="admin_phoneno" type="text" name="admin_phoneno" onkeypress="check(event)"  value="<?php echo $row['admin_phoneno'];?>" onfocusout="return mob()"placeholder="Contact" required="">
              <span class="input-group-btn">
                <label class="btn btn-primary"><span class="glyphicon glyphicon-phone" aria-hidden="true"></span></label>
            </span>
              
            </div>           
          </div>
        </div>       

        <div class="row">
          <div class="form-group col-xs-12">
            <label for="password"><span class="text-danger" style="margin-right: 5px;">*</span> Password: </label>
            <div class="input-group">
              <input class="form-control" id="admin_password" type="password" name="admin_password" onkeypress="checkspace(event)"  value="<?php echo $row['admin_password'];?>" placeholder="Password" required="">
              <span class="input-group-btn">
                <label class="btn btn-primary"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></label>
            </span>
              
            </div>           
          </div>
        </div>
        <div class="row">
          <div class="form-group col-xs-4">
              <button class="btn btn-primary" type="submit" name="submit" id="sumit" onclick="disp(event)">Submit</button>
          </div>

        </div>

        </form>

        </div>
        
      </div>
      
    </div>
    </div>
<?php 
}
?>
    </body>
</html>