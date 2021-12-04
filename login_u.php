<?php
session_start(); 
$error=''; 

if (isset($_POST['submit'])) {
if (empty($_POST['cust_username']) || empty($_POST['cust_password'])) {
$error = "Username or Password is invalid";
}
else
{
// Define $username and $password
$username=$_POST['cust_username'];
$password=$_POST['cust_password'];
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
require 'connection.php';
$conn = Connect();

// SQL query to fetch information of registerd users and finds user match.
$query = "SELECT cust_username,cust_password FROM customer WHERE cust_username=? AND cust_password=? LIMIT 1";

// To protect MySQL injection for Security purpose
$stmt = $conn->prepare($query);
$stmt -> bind_param("ss", $username, $password);
$stmt -> execute();
$stmt -> bind_result($username, $password);
$stmt -> store_result();

if ($stmt->fetch())  
{
	$_SESSION['login_user2']=$username; // Initializing Session
	header("location: foodlist.php"); // Redirecting To Other Page
} else {
$error = "Username or Password is invalid";
}
mysqli_close($conn); // Closing Connection
}
}
?>