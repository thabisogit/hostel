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

if(!empty($_POST["location"])) 
{	
$location=$_POST['location'];
$stmt = $DB_con->prepare("SELECT room_no FROM rooms WHERE location = :location");
$stmt->execute(array(':location' => $location));
?>
 <?php
 while($row=$stmt->fetch(PDO::FETCH_ASSOC))
 {
  ?>
 <?php echo "<option>".htmlentities($row['room_no'])."</option>"; ?>
  <?php
 }
}

?>