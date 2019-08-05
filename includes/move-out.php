	<?php
	session_start();
	include('includes/config.php');
	include('includes/checklogin.php');
	check_login();
	//code for add courses
	if(isset($_POST['submit']))
	{
	$userid=$_SESSION['id'];	
	$no_mates=$_POST['mates'];
	$no_days=$_POST['days'];
	$fees=$_POST['fees'];
	$summary=$_POST['summary'];
	$query="insert into roommate_requests (no_mates,no_days,total_fees,userid,summary) values(?,?,?,?,?)";
	$stmt = $mysqli->prepare($query);
	$rc=$stmt->bind_param('iidis',$no_mates,$no_days,$fees,$userid,$summary);
	$stmt->execute();
	echo"<script>alert('Request has been added successfully');</script>";
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
		<title>Request Room mate</title>
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
						
							<h2 class="page-title">Request Room mate</h2>
		
							<div class="row">
								<div class="col-md-12">
									<div class="panel panel-default">
										<div class="panel-heading">Request Room mate</div>
										<div class="panel-body">

										<?php if(isset($_POST['submit']))
	{ ?>
	
	<?php } ?>
											<form method="post" class="form-horizontal">
												
												<div class="hr-dashed"></div>

												<div class="form-group">
<label class="col-sm-2 control-label">Total Fees : </label>
<div class="col-sm-8">
<input type="text" name="fees"  id="fees" class="form-control" value="" required="required" readonly />
<input type="hidden" name="feesTotal"  id="feesTotal" class="form-control" value="<?php echo $row->fees_perday;?>" required="required" readonly />
</div>
</div>
<?php } ?>

												<div class="form-group">
<label class="col-sm-2 control-label">Summary : </label>
<div class="col-sm-8">
<textarea  rows="5" name="summary"  id="summary" class="form-control" required="required"></textarea>
</div>
</div>


	<div class="col-sm-8 col-sm-offset-2">
	<input class="btn btn-primary" type="submit" name="submit" value="Add Request ">
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
	<script type="text/javascript">

	$(document).ready(function () {
        var t1 = $('#feesTotal').val();
		var t2 = $('#days').val();
		var t = $('#mates').val();
		var tt = ((t*t2)*t1);
		$('#fees').val(tt);
    });

	function calc(t){
		var t1 = $('#feesTotal').val();
		var t2 = $('#days').val();
		var tt = ((t*t2)*t1);
		$('#fees').val(tt);
	}

	function calc2(t){
		var tt = (t*$('#mates').val());
		var tot = (tt * $('#feesTotal').val())
		$('#fees').val(tot);
	}

	</script>
	</body>

	</html>