<?php
//session_start();
include('includes/config.php');



function check_login()
{
if(strlen($_SESSION['id'])==0)
	{	
		$host = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra="index.php";		
		$_SESSION["id"]="";
		header("Location: http://$host$uri/$extra");
	}
}

function getProps($id)
{
	$mysql_hostname = "localhost";
$mysql_user = "root";
$mysql_password = "";
$mysql_database = "hostel";
$prefix = "";
// Create connection
$conn = new mysqli($mysql_hostname, $mysql_user, $mysql_password, $mysql_database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$ret= mysqli_query($conn, "SELECT count(*) as cnt from hostel.property where (property_owner_id ='".$id."' or property_owner_id is null)");
//echo "<pre>".print_r($ret,true)."</pre>";
while($row=mysqli_fetch_array($ret))
			{
				echo $row['cnt'];
			}
//$result ="SELECT count(*) from hostel.property where (property_owner_id = ? or property_owner_id is null)";
//$stmt = $mysqli->prepare($result);
//$stmt->bind_param('i',$id);
//$stmt->execute();
//$stmt -> bind_result($result);
//$stmt -> fetch(); 
//$stmt->close();

}
?>