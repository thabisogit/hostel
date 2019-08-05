		<?php
		session_start();
		include('includes/config.php');
		include('includes/checklogin.php');
		check_login();
		//code for add courses
		if(isset($_POST['submit']))
		{
			$userid=$_SESSION['id'];	
			$date=$_POST['moveoutdate'];
			$summary=$_POST['summary'];
			$query="insert into moving_out (moving_out_date,notes,userid) values(?,?,?)";
			$stmt = $mysqli->prepare($query);
			$rc=$stmt->bind_param('ssi',$date,$summary,$userid);
			$stmt->execute();
			echo"<script>alert('Request has been added successfully');</script>";
		}

		if(isset($_POST['cancelrequest']))
		{
			$userid=$_SESSION['id'];	
			$cancel='1';
			$query="update moving_out set cancel = ? where userid = ? ";
			$stmt = $mysqli->prepare($query);
			$rc=$stmt->bind_param('ii',$cancel,$userid);
			$stmt->execute();
			echo"<script>alert('Request sent to admin successfully');</script>";
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

								<h2 class="page-title">Moving Out Notice</h2>

								<div class="row">
									<div class="col-md-12">
										<div class="panel panel-default">
											<div class="panel-heading">Move out notice</div>
											<div class="panel-body">
												<?php
												$userid = $_SESSION['id'];
												$stmt->close();
												$result ="SELECT userid,moving_out_date FROM moving_out WHERE userid=?";
												$stmt = $mysqli->prepare($result);
												$stmt->bind_param('s',$userid);
												$stmt->execute();
												$stmt -> bind_result($result,$moving_out_date);
												$stmt -> fetch();

	//echo $result;exit;

												if(!$result == "") {
													echo "<span style='color:red;margin-left:250px;'> You have already made a request to move out on($moving_out_date)</span>
													<div>Send a Request to cancel your moving out request, administrator will contact you shortly to setup an arrangement for you to pay R500 to cancel your moving out request
														<input class='btn btn-primary' id='cancelrequest' type='submit' name='cancelrequest' value='Cancel Request'></div>";
													}

													else{ 
														$date = date('Y-m-d');
														echo $date;
														?>
														<form method="post" class="form-horizontal">

															<div class="hr-dashed"></div>

															<div class="form-group">
																<label class="col-sm-2 control-label">Move out date : </label>
																<div class="col-sm-8">
																<input type="date" name="moveoutdate" id="moveoutdate" onchange="validateDate(this.value)" onBlur="validateDate(this.value)"  class="form-control" required="required">
																<input type="hidden" name="cdate" id="cdate" value="<?php echo date('Y-m-d') ?>">
																<label id="warning" style="color:red;display:none">You cannot book the dates before the current date</label>
																</div>
															</div>

															<div class="form-group">
																<label class="col-sm-2 control-label">Note : </label>
																<div class="col-sm-8">
																	<textarea  rows="5" name="summary"  id="summary" class="form-control" required="required"></textarea>
																</div>
															</div>


															<div class="form-group">
																Please make sure that you are 100% sure about your decision of moving out of the 
																property because after clicking the "Move Out" 
																button below you will be deleted from the system on the "Move out date" indicated above and you will be required to book for accomodation again as a new tenant.
																If ever you request to cancel your request for moving out, you will be required to pay an extra fee of <label style="color:red">R500</label> for cancelation.
															</div>
															<div>
																Do you accept the condition above? <input type="checkbox" name="adcheck" value="1"/>
															</div>

															<div class="col-sm-8 col-sm-offset-2">
																<input class="btn btn-primary" id="moveout" type="submit" name="submit" value="Move Out ">
															</div>
														</div>

													</form>

													<?php }
													?>

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

		function validateDate(sdate){
			var cdate = $("#cdate").val();
			var seldate = sdate;

			if(cdate > seldate){
				$("#warning").show();
				$("#moveoutdate").val('');
			}else{
				$("#warning").hide();
			}
		}
			$(document).ready(function(){
				$("#moveout").hide();
				$('input[type="checkbox"]').click(function(){
					if($(this).prop("checked") == true){
						$("#moveout").show();
	                //$('#paddress').val( $('#address').val() );
	                //$('#pcity').val( $('#city').val() );
	                //$('#pstate').val( $('#state').val() );
	                //$('#ppincode').val( $('#pincode').val() );
	            }else{
	            	$("#moveout").hide();
	            } 
	            
	        });
			});
		</script>
</body>

</html>