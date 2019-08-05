<?php
include('includes/pdoconfig.php');
if(!empty($_POST["roomid"])) 
{	
$id=$_POST['roomid'];
$stmt = $DB_con->prepare("SELECT * FROM rooms WHERE room_no = :id");
$stmt->execute(array(':id' => $id));
?>
 <?php
 while($row=$stmt->fetch(PDO::FETCH_ASSOC))
 {
  ?>
 <?php echo htmlentities($row['seater']); ?>
  <?php
 }
}



if(!empty($_POST["rid"])) 
{	
$id=$_POST['rid'];
$stmt = $DB_con->prepare("SELECT * FROM rooms WHERE room_no = :id");
$stmt->execute(array(':id' => $id));
?>
 <?php
 while($row=$stmt->fetch(PDO::FETCH_ASSOC))
 {
  ?>
 <?php echo htmlentities($row['fees']); ?>
  <?php
 }
}

if(!empty($_POST["staydate"]) && !empty($_POST["days"])  && !empty($_POST["userid"])) 
{	
$date=$_POST['staydate'];
if($date < date('Y-m-d')){
	echo '3';
}else{
$days=$_POST['days'];
$userid = $_POST['userid'];
$todate = strtotime($date);
$baseDate = strtotime(''.$days.' days',$todate);
 $update = date("Y-m-d",$baseDate);


$stmt = $DB_con->prepare("SELECT moving_out_date FROM moving_out WHERE userid = :userid");
//echo $stmt;exit;
$stmt->execute(array(':userid' => $userid));

?>
 <?php
 while($row=$stmt->fetch(PDO::FETCH_ASSOC))
 {
 	if($row['moving_out_date'] > $update){
 		echo '0';
 	}else{
 		echo '1';
 		
 	}
 	
  ?>
  <?php
 }
 }
}

?>