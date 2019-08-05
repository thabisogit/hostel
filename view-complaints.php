<?php
session_start();

//  if(time() - $_SESSION['timestamp'] < 900) { //subtract new timestamp from the old one
//     echo"<script>alert('15 Minutes over!');</script>";
//     unset($_SESSION['username'], $_SESSION['password'], $_SESSION['timestamp']);
//     $_SESSION['logged_in'] = false;
//     header("Location: logout.php"); //redirect to index.php
//     exit;
// } else {
//     $_SESSION['timestamp'] = time(); //set new timestamp
// }


include('includes/config.php');
include('includes/checklogin.php');

$mysql_hostname = "localhost";
$mysql_user = "root";
$mysql_password = "";
$mysql_database = "hostel";
$prefix = "";
//$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Could not connect database");
//mysql_select_db($mysql_database, $bd) or die("Could not select database");

// Create connection
$conn = new mysqli($mysql_hostname, $mysql_user, $mysql_password, $mysql_database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

check_login();

if(isset($_GET['del']))
{
	$id=intval($_GET['del']);
	$adn="delete from complaints where id=?";
		$stmt= $mysqli->prepare($adn);
		$stmt->bind_param('i',$id);
        $stmt->execute();
        $stmt->close();	   
        echo "<script>alert('Data Deleted');</script>" ;
}
?>
<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	<title>Manage complaints</title>
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<link rel="stylesheet" href="css/fileinput.min.css">
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	<?php include('includes/header.php');?>

	<div class="ts-main-content">
			<?php include('includes/sidebar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<h2 class="page-title">Manage complaints</h2>
						<div class="panel panel-default">
							<div class="panel-heading">All Room Details</div>
							<div class="panel-body">
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th style="text-align:center;">Sno.</th>
											<th>Complaint</th>
											<th style="text-align:center;">Date Posted.</th>
											<th style="text-align:center;">Seen By Admin</th>
											<th style="text-align:center;">Action</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th style="text-align:center;">Sno.</th>
											<th>Complaint</th>
											<th style="text-align:center;">Date Posted.</th>
											<th style="text-align:center;">Seen By Admin</th>
											<th style="text-align:center;">Action</th>
										</tr>
									</tfoot>
									<tbody>
<?php	
$id=intval($_SESSION['id']);
//echo $id;exit;
$cnt=1;
$ret = mysqli_query($conn, "select * from complaints where userid=".$id);

while($row=mysqli_fetch_array($ret))
			{
				if($row['resp'] == 1){
					$resp = 'View Response';
					$color = 'color:green';
				}elseif ($row['resp'] != 1) {
					$resp = 'No';
					$color = 'color:red';
				}

				if($row['seen'] == 1 && $row['resp'] != 1){
					$resp = 'Seen, no response';
					$color = 'color:orange';
				}
				?>

<tr><td style="text-align:center;"><?php echo $cnt;?></td>
<td><?php echo $row['complaint'];?></td>
<td style="text-align:center;"><?php echo $row['dateposted'];?></td>
<td style="text-align:center;"><a href="view-response.php?id=<?php echo $row['id'];?>" style="text-align:center;<?php echo $color; ?>"><?php echo $resp;?></a></td>
<td style="text-align:center;">
<a href="view-complaints.php?del=<?php echo $row['id'];?>" onclick="return confirm("Do you want to delete");"><i class="fa fa-close"></i></a></td>
										</tr>
									<?php
$cnt=$cnt+1;
									 } ?>
											
										
									</tbody>
								</table>

								
							</div>
							<div style="margin-left:15px;">
							<div><label>
								Data Key
							</label></div>
							<div><label style="color:green">
								View Response - Admin has responded to you complaint.
							</label></div>

							<div><label style="color:orange">
								No - Admin has viewed you complaint but not responded yet.
							</label></div>

							<div><label style="color:red">
								No - Admin has not seen your complaint yet.
							</label></div>
							</div>
						</div>

					
					</div>
				</div>

			

			</div>
		</div>
	</div>

	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>

</body>

</html>
