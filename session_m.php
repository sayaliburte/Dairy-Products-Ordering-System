<?php
require 'connection.php';
$conn = Connect();

session_start();

$user_check=$_SESSION['login_user1'];

// SQL Query To Fetch Complete Information Of User
$query = "SELECT admin_username FROM admin WHERE admin_username = '$user_check'";
$ses_sql = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($ses_sql);
$login_session =$row['admin_username'];


?>