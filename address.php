<?php
session_start(); 
if (isset($_POST['submit'])) {
if (empty($_POST['cust_address'])) {
$error = "Please Enter Address";
}
}
else
{
	$add=$_POST['cust_address'];
	$_SESSION['address']=$add; //Initializing Session
	header("location:cart.php");//Redirecting To cart Page
}
?>