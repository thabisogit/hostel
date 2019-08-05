<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();
//code for add courses
if($_POST['submit'])
{
$response=$_POST['response'];
$viewed='1';
$resp='1';
$id=$_GET['id'];
$query="update roommate_requests set accepted=?,id=?";
$stmt = $mysqli->prepare($query);
$rc=$stmt->bind_param('si',$response,$id);
$stmt->execute();
$stmt->close();
echo"<script>alert('Responded successfully');</script>";
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
	<title>Respond to Room Mate Request</title>
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
					
						<h2 class="page-title">Respond to Room Mate Request</h2>
	
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Respond to Room Mate Request</div>
									<div class="panel-body">
										<form method="post" class="form-horizontal">

<?php 
$id=$_GET['id'];
$ret="SELECT * from hostel.roommate_requests 
left join hostel.registration on registration.id = roommate_requests.userid where roommate_requests.id = ?";
	$stmt= $mysqli->prepare($ret) ;
	 $stmt->bind_param('i',$id);
	 $stmt->execute() ;//ok
	 $res=$stmt->get_result();
	 //$cnt=1;
	   while($row=$res->fetch_object())
	  {
	  	
	  	?>
										<div class="form-group">
<label class="col-sm-2 control-label">Tenant Name:</label>
<div class="col-sm-8">
<label  class="col-sm-2 control-label" style="text-align:left"><?php echo $row->firstName;?></label>
</div>
</div>


										<div class="form-group">
<label class="col-sm-2 control-label">Tenant Surname:</label>
<div class="col-sm-8">
<label  class="col-sm-2 control-label" style="text-align:left"><?php echo $row->lastName;?></label>
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Tenant Contact:</label>
<div class="col-sm-8">
<label  class="col-sm-2 control-label" style="text-align:left"><?php echo $row->contactno;?></label>
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Tenant email:</label>
<div class="col-sm-8">
<label  class="col-sm-2 control-label" style="text-align:left"><?php echo $row->emailid;?></label>
</div>
</div>

										<div class="form-group">
<label class="col-sm-2 control-label">Tenant Location:</label>
<div class="col-sm-8">
<label  class="col-sm-2 control-label" style="text-align:left"><?php echo $row->location;?></label>
</div>
</div>

										<div class="form-group">
<label class="col-sm-2 control-label">Seater:</label>
<div class="col-sm-8">
<label  class="col-sm-2 control-label" style="text-align:left"><?php echo $row->seater;?></label>
</div>
</div>
<?php } ?>

												<?php
											$id=$_GET['id'];
	$ret="select * from roommate_requests where id=?";
	$stmt= $mysqli->prepare($ret) ;
	 $stmt->bind_param('i',$id);
	 $stmt->execute() ;//ok
	 $res=$stmt->get_result();
	 //$cnt=1;
	   while($row=$res->fetch_object())
	  {
	  	
	  	?>
						<div class="hr-dashed"></div>

						<div class="form-group" style="margin-left: 10px;">
						I would like to bring <strong><?php echo $row->no_mates;?></strong> temporary room mate(s) over for <strong><?php echo $row->no_mates;?> day(s)</strong> from <strong><?php echo $row->stay_from_date;?></strong> and I agree to pay the amount of <strong>R<?php echo $row->total_fees;?></strong>.
					</div>

					<div class="form-group" style="margin-left: 20px;">
					<select id="response" name="response" placeholder="Respond to above request" class="form-control">
						<option value="">--Please Select--</option>
						<option value="1">Accepted</option>
						<option value="0">Rejected</option>
					</select>
					</div>

<?php } ?>
												<div style="margin-left: 20px;">
													
													<input class="btn btn-primary" type="submit" name="submit" value="Respond">
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