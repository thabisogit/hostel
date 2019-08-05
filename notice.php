<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');

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

check_login();

if(isset($_GET['del']))
{
	$id=intval($_GET['del']);
	$adn="delete from notice where id=?";
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
	<title>Latest Notices</title>
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
						<h2 class="page-title">Latest Notices</h2>
						<div class="panel panel-default">
							<div class="panel-heading">Latest Notices</div>
							<div class="panel-body">
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th style="text-align:center;">Sno.</th>
											<th>Notice</th>
											<th style="text-align:center;">Date Posted.</th>
											<th style="text-align:center;">Importancy</th>
											<th style="text-align:center;">Action</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th style="text-align:center;">Sno.</th>
											<th>Notice</th>
											<th style="text-align:center;">Date Posted.</th>
											<th style="text-align:center;">Importancy</th>
											<th style="text-align:center;">Action</th>
										</tr>
									</tfoot>
									<tbody>
<?php	
$id=intval($_SESSION['id']);

$cnt=1;
$ret = mysqli_query($conn, "select * from notice order by dateposted DESC");

while($row=mysqli_fetch_array($ret))
			{?>
<tr style="<?=($row['important'] == 'Very Important') ? "color: red" : "color: green" ?>"><td style="text-align:center;"><?php echo $cnt;?></td>
<td><?php echo $row['notice'];?></td>
<td style="text-align:center;"><?php echo $row['dateposted'];?></td>
<td style="text-align:center; color:red"><a href="view-response.php?id=<?php echo $row['id'];?>" style="text-align:center;<?=($row['important'] == 'Very Important') ? "color: red" : "color: green" ?>"><?= $row['important'] ?></a></td>
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
								Updates.
							</label></div>

							<div><label style="color:orange">
								Important.
							</label></div>

							<div><label style="color:red">
								Very Important.
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
