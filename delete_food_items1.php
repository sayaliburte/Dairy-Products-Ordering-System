<?php
include('session_m.php');

if(!isset($login_session)){
header('Location: managerlogin.php'); 
}

$cheks =$_POST['checkbox'];
foreach($cheks as $id)
{
$sql = "DELETE FROM product WHERE p_id ='".$id."'";
$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
}
header('Location: delete_food_items.php');
$conn->close();


?>