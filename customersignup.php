<html>
<head>
    <title> Guest Signup | SHRAVAN DAIRY </title>
  </head>

  <link rel="stylesheet" type = "text/css" href ="css/managersignup.css">
  <link rel="stylesheet" type = "text/css" href ="css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script>
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
			function checkall()
			{
				var mob=document.getElementById("cust_phoneno").value;
				var add=document.getElementById("cust_address").value;
				var passwd=document.getElementById("cust_password").value;
				var lowerCaseLetters = /[a-z]/g;
				var upperCaseLetters = /[A-Z]/g;
				var numbers = /[0-9]/g;
				var pass=document.getElementById("cust_password").value;
				var con=document.getElementById("con_password").value;
				var user=document.getElementById("cust_username").value;
				if(mob.length!=10)
				{
					alert("Mobile Number must have size 10 Please Check it!!");
					document.getElementById("cust_phoneno").focus();
					return false;
				}	
				else if(add.length<25)
				{
					alert("Please Enter Full Address!!!");
					document.getElementById("cust_address").focus();
					return false;
				}
				else if(pass!=con)
				{
					alert("Please Enter  Same Password");
					document.getElementById("con_password").focus();
					return false;
				}
				else if(user.length<10)
				{
					alert("Username must have 10 character");
					document.getElementById("cust_username").focus();
					return false;
				}
				else if(pass.length<8)
				{
					alert("Password Must Contain minimum 8 Character");
					document.getElementById("cust_password").focus();
					return false;
				}
				else if(passwd.match(numbers) ||passwd.match(lowerCaseLetters) ||passwd.match(upperCaseLetters))
				{
					return true;
				}
				else
				{
					alert("Password Must Contain Atleast One Uppercase Lowercase Character And One Number");
					document.getElementById("cust_password").focus();
					return false;
				}
				return true;
			}	
	</script>
  <body>
<?php
if (isset($_GET['submit'])) 
{
	require 'connection.php';
	$conn = Connect();	
	$cust_username = $conn->real_escape_string($_GET['cust_username']);
	$cust_name = $conn->real_escape_string($_GET['cust_name']);
	$emailid = $conn->real_escape_string($_GET['emailid']);	
	$cust_address = $conn->real_escape_string($_GET['cust_address']);
	$cust_phoneno = $conn->real_escape_string($_GET['cust_phoneno']);	
	$cust_password = $conn->real_escape_string($_GET['cust_password']);
	$query1="SELECT cust_username FROM customer WHERE cust_username='".$cust_username."';";
	$result=$conn->query($query1);
	if (mysqli_num_rows($result)<=0)
	{
		$query = "INSERT into customer(cust_username,cust_name,emailid,cust_address,cust_phoneno,cust_password) VALUES('" . $cust_username. "','" .$cust_name  . "','" . $emailid . "','" .$cust_address."','" . $cust_phoneno. "','" . $cust_password ."')";
		$success = $conn->query($query);

		if (!$success){
			die("Couldnt enter data: ".$conn->error);
		}
		header("Location: customer_registered_success.php"); 
		$conn->close();
		
	}
	else
	{?>
		<script type="text/javascript">alert("Username Already Exists Please Enter Different Username!");
		var name="<?php echo $cust_name ;?>"
		var name="<?php echo $cust_name ;?>"	
		var uname="<?php echo $cust_username;?>"
		var mail="<?php echo $emailid ;?>"
		var add="<?php echo $cust_address ;?>"
		var num="<?php echo $cust_phoneno ;?>"
		var pass="<?php echo $cust_password;?>"
		document.getElementById("cust_name").value=name;	
		document.getElementById("cust_username").value=uname;	
		document.getElementById("emailid").value=mail;
		document.getElementById("cust_address").value=add;
		document.getElementById("cust_phoneno").value=num;
		document.getElementById("cust_password").value=pass;
		</script>
	
	<?php
	}	
}
?>
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
            <li  ><a href="index.php">Home</a></li>
            <li><a href="aboutus.php">About</a></li>
          </ul>

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
        </div>

      </div>
    </nav>

    <div class="container">
    <div class="jumbotron">
     <h1>Hi Guest, <br> Welcome to <span class="edit"> SHRAVAN DAIRY</span></h1>
     <br>
   <p>Get started by creating your account</p>
    </div>
    </div>



    <div class="container" style="margin-top: 4%; margin-bottom: 2%;">
      <div class="col-md-5 col-md-offset-4">
      <div class="panel panel-primary">
        <div class="panel-heading"> Create Account </div>
        <div class="panel-body">
          
        <form role="form" action="customersignup.php" method="GET" autocomplete="off" onsubmit="return checkall()">
         
          <div class="row">
          <div class="form-group col-xs-12">
            <label for="fullname"><span class="text-danger" style="margin-right: 5px;">*</span> Full Name: </label>
            <div class="input-group">
              <input class="form-control" id="cust_name" type="text" name="cust_name" onkeypress="checknum(event)" placeholder="Your Full Name" required="" autofocus="">
              <span class="input-group-btn">
                <label class="btn btn-primary"><span class=".glyphicon glyphicon-user" aria-hidden="true"></label>
            </span>
              </span>
            </div>           
          </div>
        </div>

        <div class="row">
          <div class="form-group col-xs-12">
            <label for="username"><span class="text-danger" style="margin-right: 5px;">*</span> Username: </label>
            <div class="input-group">
              <input class="form-control" id="cust_username" type="text" name="cust_username" onkeypress="checkspace(event)" placeholder="Your Username " required="">
              <span class="input-group-btn">
                <label class="btn btn-primary"><span class="glyphicon glyphicon-user" aria-hidden="true"></label>
            </span>
              </span>
            </div>           
          </div>
        </div>

        <div class="row">
          <div class="form-group col-xs-12">
            <label for="email"><span class="text-danger" style="margin-right: 5px;">*</span> Email: </label>
            <div class="input-group">
              <input class="form-control" id="emailid" type="email" name="emailid" placeholder="Email" required="">
              <span class="input-group-btn">
                <label class="btn btn-primary"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></label>
            </span>
              </span>
            </div>           
          </div>
        </div>

<div class="row">
          <div class="form-group col-xs-12">
            <label for="address"><span class="text-danger" style="margin-right: 5px;">*</span> Address: </label>
            <div class="input-group">
              <input class="form-control" id="cust_address" type="text" name="cust_address" placeholder=" Full Address"  required="">
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
              <input class="form-control" id="cust_phoneno" type="text" name="cust_phoneno" onkeypress="check(event)" placeholder="Contact" required="">
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
              <input class="form-control" id="cust_password" type="password" name="cust_password" onkeypress="checkspace(event)"  placeholder="Password" required="">
              <span class="input-group-btn">
                <label class="btn btn-primary"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></label>
            </span>
              
            </div>           
          </div>
        </div>

<div class="row">
          <div class="form-group col-xs-12">
            <label for="password"><span class="text-danger" style="margin-right: 5px;">*</span>Confirm Password: </label>
            <div class="input-group">
              <input class="form-control" id="con_password" type="password" name="con_password" onkeypress="checkspace(event)" onfocusout="correct()"placeholder="Password" required="">
              <span class="input-group-btn">
                <label class="btn btn-primary"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></label>
            </span>
              
            </div>           
          </div>
        </div>
        

        <div class="row">
          <div class="form-group col-xs-4">
              <button class="btn btn-primary" id="submit" name="submit" type="submit">Submit</button>
          </div>

        </div>
        <label style="margin-left: 5px;">or</label> <br>
       <label style="margin-left: 5px;"><a href="customerlogin.php">Have an account? Login.</a></label>

        </form>

        </div>
        
      </div>
      
    </div>
    </div>

    </body>
</html>