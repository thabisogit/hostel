<?php 
session_start();
$aid=$_SESSION['id'];
require_once("includes/config.php");
if(!empty($_POST["roomno"])) 
{
	$roomno=$_POST["roomno"];
	$result ="SELECT count(*) AS ro, rooms.seater FROM registration LEFT JOIN rooms ON room_no = registration.roomno WHERE roomno = ? GROUP BY rooms.seater;";
	$stmt = $mysqli->prepare($result);
	$stmt->bind_param('i',$roomno);
	$stmt->execute();
	$stmt->bind_result($count,$seater);
	$stmt->fetch();
	$stmt->close();
//echo "<script>alert($count);</script>";
	if($count == ""){
		echo "<span style='color:green'>All $count seats are available</span>";
	}else if($count < $seater){
		echo "<span style='color:orange'>$count seats already full</span>";
	}else if($count >= $seater){
		echo "<span style='color:red'>Room full</span>";
	}
}

if(!empty($_POST["oldpassword"])) 
{
	$pass=$_POST["oldpassword"];
	$result ="SELECT password FROM userregistration WHERE password=?";
	$stmt = $mysqli->prepare($result);
	$stmt->bind_param('s',$pass);
	$stmt->execute();
	$stmt -> bind_result($result);
	$stmt -> fetch();
	$opass=$result;
	if($opass==$pass) 

		echo "<span style='color:green'> Password  matched .</span>";
	else echo "<span style='color:red'> Password Not matched</span>";
}
?>
