	<?php
	session_start();
	include('includes/config.php');
	include('includes/checklogin.php');
	check_login();
	//code for add courses
	if(isset($_POST['submit']))
	{
	//$hasmates=$_SESSION['hasMates'];

	$nomates = $_POST['nomate'];
	$nodays = $_POST['nodays'];
	$fees_perday = $_POST['fees'];

	$query="update roommates set no_mates=?,no_days=?, fees_perday=?";
$stmt = $mysqli->prepare($query);
$rc=$stmt->bind_param('iid',$nomates,$nodays,$fees_perday);
$stmt->execute();
$stmt->close();
echo"<script>alert('Updated successfully');</script>";
	
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
		<title>Room mates Management</title>
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
						
							<h2 class="page-title">Temporary Room mates Management</h2>
		
							<div class="row">
								<div class="col-md-12">
									<div class="panel panel-default">
										<div class="panel-heading">Temporary Room mate Management</div>
										<div class="panel-body">
										<?php if(isset($_POST['submit']))
	{ ?>
	
	<?php } ?>
											<form method="post" class="form-horizontal">
											<?php	
$id=intval($_SESSION['id']);
//$stmt->close();

$ret="select * from roommates";

$stmt= $mysqli->prepare($ret) ;
$stmt->execute() ;//ok
$res=$stmt->get_result();
//$row=$res->fetch_object();

//$_SESSION['hasMates'] = $has;

	  while($row=$res->fetch_object())
	  {
	  	?>
												
<div class="hr-dashed"></div>
<div class="form-group">
<label class="col-sm-2 control-label">Max No. of room mates:</label>
<div class="col-sm-8">
<input type="text" name="nomate" id="nomate" class="form-control" value="<?php echo $row->no_mates;?>" required="required" >
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Max No. of days :</label>
<div class="col-sm-8">
<input type="text" name="nodays" id="nodays" class="form-control" value="<?php echo $row->no_days;?>" required="required" >
</div>
</div>

												<div class="form-group">
<label class="col-sm-2 control-label">Fees per day: </label>
<div class="col-sm-8">
<input type="text" name="fees" id="fees" class="form-control" value="<?php echo $row->fees_perday;?>" required="required" >
</div>
</div>

<?php } ?>
	<div class="col-sm-8 col-sm-offset-2">
	<input class="btn btn-primary" type="submit" name="submit" value="Update ">
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