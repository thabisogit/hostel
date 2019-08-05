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
	//code for add courses
	if(isset($_POST['submit']))
	{
	$important=$_POST['important'];	
	$notice=$_POST['notice'];
	$dateposted=date('Y-m-d');
	$query="insert into  notice (notice,important,dateposted) values(?,?,?)";
	$stmt = $mysqli->prepare($query);
	$rc=$stmt->bind_param('sss',$notice,$important,$dateposted);
	$stmt->execute();
	echo"<script>alert('Notice has been added successfully');</script>";
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
		<title>Create Notice</title>
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
						
							<h2 class="page-title">Add Notice </h2>
		
							<div class="row">
								<div class="col-md-12">
									<div class="panel panel-default">
										<div class="panel-heading">Add Notice</div>
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
			{
				$color = '';
				if($row['important'] == 'Very Important'){
					$color = 'color: red';
					}elseif($row['important'] == 'Important'){
						$color = 'color: orange';
						}elseif($row['important'] == 'Updates'){
							$color = 'color: green';
							}?>
<tr style="<?= $color ?>"><td style="text-align:center;"><?php echo $cnt;?></td>
<td><?php echo $row['notice'];?></td>
<td style="text-align:center;"><?php echo $row['dateposted'];?></td>
<td style="text-align:center; color:red"><a href="view-response.php?id=<?php echo $row['id'];?>" style="text-align:center;<?= $color  ?>"><?= $row['important'] ?></a></td>
<td style="text-align:center;">
<a href="view-complaints.php?del=<?php echo $row['id'];?>" onclick="return confirm("Do you want to delete");"><i class="fa fa-close"></i></a></td>
										</tr>
									<?php
$cnt=$cnt+1;
									 } ?>
											
										
									</tbody>
								</table>
										
											<form method="post" class="form-horizontal">
												
												<div class="hr-dashed"></div>
												<div class="form-group">
<label class="col-sm-2 control-label">Notice : </label>
<div class="col-sm-8">
<textarea  rows="5" name="notice"  id="notice" class="form-control" required="required"></textarea>
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Importancy</label>
<div class="col-sm-8">
<select name="important" id="important" class="form-control">
<option value="">Please Select</option>
<option value="Updates">Updates</option>
<option value="Important">Important</option>
<option value="Very Important">Very Important</option>
</select>
</div>
</div>


	<div class="col-sm-8 col-sm-offset-2">
	<input class="btn btn-primary" type="submit" name="submit" value="Add Notice ">
													</div>
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