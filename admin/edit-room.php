<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();
//code for add courses
if(isset($_POST['submit']))
{
$seater=$_POST['seater'];
$fees=$_POST['fees'];
$location=$_POST['location'];
$id=$_GET['id'];
$property_owner_id=$_GET['property_owner_id'];
$property_id=$_GET['property_id'];
$occupants=$_POST['occupants'];
$query="update rooms set seater=?,fees=?, location=? , property_id=?, property_owner_id=?, no_occupants=? where id=?";
$stmt = $mysqli->prepare($query);
$rc=$stmt->bind_param('iisiiii',$seater,$fees,$location,$property_id,$property_owner_id,$occupants,$id);
$stmt->execute();
echo"<script>alert('Room Details has been Updated successfully');</script>";
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
	<title>Edit Room Details</title>
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
					
						<h2 class="page-title">Edit Room Details </h2>
	
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Edit Room Details</div>
									<div class="panel-body">
										<form method="post" class="form-horizontal">
												<?php	
												$id=$_GET['id'];
	$ret="select * from rooms where id=?";
		$stmt= $mysqli->prepare($ret) ;
	 $stmt->bind_param('i',$id);
	 $stmt->execute() ;//ok
	 $res=$stmt->get_result();
	 //$cnt=1;
	   while($row=$res->fetch_object())
	  {
	  	$loc = $row->location;
	  	if($loc){
	  		$loc = $row->location;
	  	}else{
	  		$loc = "Select Location";
	  	}
	  	?>
						<div class="hr-dashed"></div>

						<div class="form-group">
	<label class="col-sm-2 control-label">Select Location</label>
													<div class="col-sm-8">
													<Select name="location" class="form-control" required>
													<option value="<?php echo $row->location;?>"><?php echo $loc;?></option>
	<?php
	 $ret1="select concat(city,' ',surbub,' ',line1,' ',line2,' ',line3,' ',pcode) As Location from locations;";
	$stmt1= $mysqli->prepare($ret1) ;
	//$stmt->bind_param('i',$aid);
	$stmt1->execute() ;//ok
	$res1=$stmt1->get_result();
	//$cnt=1;
	while($row1=$res1->fetch_object())
		  {
		  	?>
	<option value="<?php echo $row1->Location;?>"><?php echo $row1->Location;?></option>
										<?php
										 } ?>

	</Select>
	</div>
	</div>

						<div class="form-group">
						<label class="col-sm-2 control-label">Seater  </label>
					<div class="col-sm-8">
					<input type="text"  name="seater" value="<?php echo $row->seater;?>"  class="form-control"> </div>
					</div>
				 <div class="form-group">
				<label class="col-sm-2 control-label">Room no </label>
		<div class="col-sm-8">
	<input type="text" class="form-control" name="rmno" id="rmno" value="<?php echo $row->room_no;?>" disabled>
	<span class="help-block m-b-none">
													Room no can't be changed.</span>
						 </div>
						</div>
<div class="form-group">
									<label class="col-sm-2 control-label">Fees (PM) </label>
									<div class="col-sm-8">
									<input type="text" class="form-control" name="fees" value="<?php echo $row->fees;?>" >
												</div>
											</div>

											<div class="form-group">
									<label class="col-sm-2 control-label">Maximum Occupants</label>
									<div class="col-sm-8">
									<input type="text" class="form-control" name="occupants" value="<?php echo $row->no_occupants;?>" >
												</div>
											</div>


<?php } ?>
												<div class="col-sm-8 col-sm-offset-2">
													
													<input class="btn btn-primary" type="submit" name="submit" value="Update Room Details ">
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