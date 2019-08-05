<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();
//code for add courses
if(isset($_POST['submit']))
{
		$city=$_POST['city'];
$surbub=$_POST['surbub'];
$line1=$_POST['line1'];
$line2=$_POST['line2'];
$line3=$_POST['line3'];
$roomno=$_POST['pcode'];

if(!isset($_GET['id'])){


$sql="SELECT pcode FROM locations where pcode=?";
$stmt1 = $mysqli->prepare($sql);
$stmt1->bind_param('i',$roomno);
$stmt1->execute();
$stmt1->store_result(); 
$row_cnt=$stmt1->num_rows;;
if($row_cnt>0)
{
echo"<script>alert('Room alreadt exist');</script>";
}
}

else
{
//$query="INSERT INTO  locations (city,surbub,line1,line2,line3,pcode) VALUES (?,?,?,?,?,?)";
//$stmt = $mysqli->prepare($query);
//echo $stmt;exit;
//$stmt->bind_param('sssssi',$city,$surbub,$line1,$line2,$line3,$roomno);
//$stmt->execute();
if(isset($_GET['id'])){
$id=$_GET['id'];
$query="UPDATE locations set city =? ,surbub =? ,line1 =? ,line2 =? ,line3 =? ,pcode=? where Id=? ";
$stmt = $mysqli->prepare($query);
$rc=$stmt->bind_param('sssssii',$city,$surbub,$line1,$line2,$line3,$roomno,$id);
$stmt->execute();
echo"<script>alert('Location Details has been Updated successfully');</script>";
}else
{
	$query1="INSERT INTO  locations (city,surbub,line1,line2,line3,pcode) VALUES (?,?,?,?,?,?)";
$stmt1= $mysqli->prepare($query1);
$stmt1->bind_param('sssssi',$city,$surbub,$line1,$line2,$line3,$roomno);
$stmt1->execute();

echo"<script>alert('Location has been added successfully');</script>";
}

}
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
	<title>Create Location</title>
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
					
						<h2 class="page-title">Add Location </h2>
	
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Add Location</div>
									<div class="panel-body">
									<?php if(isset($_POST['submit']))
{ ?>
<p style="color: red"><?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg']=""); ?></p>
<?php } ?>
										<form method="post" class="form-horizontal">

																							<?php
	
	if(!isset($_GET['id'])){
		$id='00';
	}else{
		$id=$_GET['id'];
	}


	
	//$id='';
	$ret="select * from locations where id=?";
	$stmt= $mysqli->prepare($ret) ;
	$stmt->bind_param('i',$id);
	$stmt->execute() ;//ok
	$res=$stmt->get_result();
	 //$cnt=1;
	$row=$res->fetch_object();
	
	
if(!isset($_GET['id'])){
	$city = "";
	$surbub = "";
	$line1 = "";
	$line2 = "";
	$line3 = "";
	$pcode = "";
}else{
	$city = $row->city;
	$surbub = $row->surbub;
	$line1 = $row->line1;
	$line2 = $row->line2;
	$line3 = $row->line3;
	$pcode = $row->pcode;
}
	  	?>
											<div class="hr-dashed"></div>
											<div class="form-group">
												<label class="col-sm-2 control-label">City </label>
												<div class="col-sm-8">
												<input type="text" class="form-control" name="city" id="city" value="<?php echo $city; ?>" required="required">
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">Suburb</label>
<div class="col-sm-8">
<input type="text" class="form-control" name="surbub" id="surbub" value="<?php echo $surbub; ?>" required="required">
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">Address line1</label>
<div class="col-sm-8">
<input type="text" class="form-control" name="line1" id="line1" value="<?php echo $line1; ?>" required="required">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Address line2</label>
<div class="col-sm-8">
<input type="text" class="form-control" name="line2" id="line2" value="<?php echo $line2; ?>">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Address line3</label>
<div class="col-sm-8">
<input type="text" class="form-control" name="line3" id="line3" value="<?php echo $line3; ?>">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Code</label>
<div class="col-sm-8">
<input type="text" class="form-control" name="pcode" id="pcode" value="<?php echo $pcode; ?>" required="required">
</div>
</div>
<?php 
	//}
	//}?>


									   
<div class="col-sm-8 col-sm-offset-2">
<input class="btn btn-primary" type="submit" name="submit" value="Save Location ">
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