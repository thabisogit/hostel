<?php
session_start();
//include("includes/config.php");
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
?>
<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();


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
	<title>Response to Complaint</title>
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">>
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<link rel="stylesheet" href="css/fileinput.min.css">
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<link rel="stylesheet" href="css/style.css">
<script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
<script type="text/javascript" src="js/validation.min.js"></script>
</head>
<body>
	<?php include('includes/header.php');?>
	<div class="ts-main-content">
		<?php include('includes/sidebar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">
					
						<h2 class="page-title">Response to Complaint</h2>
	
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Response to Complaint</div>
									<div class="panel-body">
										<form method="post" class="form-horizontal">
												<?php	
												$id=$_GET['id'];
	//$ret="select * from complaints where id=2";
	$ret = mysqli_query($conn, "select * from roommate_requests where id=".$id);
 
	 
	   while($row=mysqli_fetch_array($ret))
			{
	  	?>	
						<div class="hr-dashed"></div>

						<div class="form-group" style="margin-left: 10px;">
						<label>Response :</label> : I would like to bring <strong><?php echo $row['no_mates'];?></strong> temporary room mate(s) over for <strong><?php echo $row['no_mates'];?> day(s)</strong> from <strong><?php echo $row['stay_from_date'];?></strong> and I agree to pay the amount of <strong>R<?php echo $row['total_fees'];?></strong>.
					</div>

					<div class="form-group" style="margin-left: 20px; <?= ($row['accepted'] == '1' ? "color:green" : "color:red")?>">
					<label>Response :</label><?= ($row['response'] == '' || $row['response']= null) ? "No response notes" : $row['response'] ?>
					</div>

<?php 


	} ?>
												
											</div>

										</form>

									</div>
								</div>
							</div>
							</div>
						</div>
					</div>
				</div> 
			</div>
		</div>
	</div>
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>

</script>
</body>

</html>