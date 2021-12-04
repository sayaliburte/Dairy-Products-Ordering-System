<?php
session_start(); 
$error=''; 

if (isset($_POST['submit'])) {
if (empty($_POST['admin_username']) || empty($_POST['admin_password'])) {
$error = "Username or Password is invalid";
}
else
{
// Define $username and $password
$username=$_POST['admin_username'];
$password=$_POST['admin_password'];
require 'connection.php';
$conn = Connect();

// SQL query to fetch information of registerd users and finds user match.
$query = "SELECT admin_username,admin_password FROM admin WHERE admin_username=? AND admin_password=? LIMIT 1";

$stmt = $conn->prepare($query);
$stmt -> bind_param("ss", $username, $password);
$stmt -> execute();
$stmt -> bind_result($username, $password);
$stmt -> store_result();

if ($stmt->fetch())  
{
	$_SESSION['login_user1']=$username; // Initializing Session
	header("location: myrestaurant.php"); // Redirecting To Other Page
} else {
$error = "Username or Password is invalid";
}
mysqli_close($conn); // Closing Connection
}
}
?>