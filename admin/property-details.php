<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();

if(isset($_GET['del']))
{
	$id=intval($_GET['del']);
	$adn="delete from rooms where Id=?";
		$stmt= $mysqli->prepare($adn);
		$stmt->bind_param('i',$id);
        $stmt->execute();
        $stmt->close();	   
        echo "<script>alert('Room Deleted');</script>" ;
}

if(isset($_GET['dele']))
{
	$id=intval($_GET['del']);
	$adn="delete from tenantregistration where Id=?";
		$stmt= $mysqli->prepare($adn);
		$stmt->bind_param('i',$id);
        $stmt->execute();
        $stmt->close();	   
        echo "<script>alert('Tenant Deleted');</script>" ;
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
	<title>Property Details</title>
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
						<h2 class="page-title">Property Details</h2>
<div><label><a href="#" onclick="showrooms()"><label id="show">Show</label><label style="display:none" id="hide">Hide</label> All Rooms</a></label></div>
<div><label><a href="#" onclick="showtenants()"><label id="show1">Show</label><label style="display:none" id="hide1">Hide</label> All Tenants</a></label></div>
						
						<div id="allrooms" style="display:none;">
						<div class="panel panel-default">
							<div class="panel-heading">All Property Rooms<label><a href="create-room.php?property_id=<?php echo $_GET['property_id']; ?>&property_owner_id=<?php echo $_GET['property_owner_id']; ?>" style="margin-left:810px">Add New Room</a></label></div>
							<div class="panel-body">
								<table class="zctb display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>Sno.</th>
										
											<th>Seater</th>
											<th>Room No.</th>
											<th>Fees (PM) </th>

											<th>Posting Date  </th>
											<th>Action</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>Sno.</th>
											<th>Seater</th>
											<th>Room No.</th>
										
											<th>Fees (PM) </th>
											<th>Posting Date  </th>
											<th>Action</th>
										</tr>
									</tfoot>
									<tbody>
<?php	
$property_owner_id=$_GET['property_owner_id'];
$property_id=$_GET['property_id'];
$ret="select * from rooms where property_owner_id=? and property_id=?";
$stmt= $mysqli->prepare($ret) ;
$stmt->bind_param('ii',$property_owner_id,$property_id);
$stmt->execute() ;//ok
$res=$stmt->get_result();
$cnt=1;
while($row=$res->fetch_object())
	  {
	  	?>
<tr><td><?php echo $cnt;?></td>
<td><?php echo $row->seater;?></td>
<td><?php echo $row->room_no;?></td>
<td><?php echo $row->fees;?></td>
<td><?php echo $row->posting_date;?></td>
<td><a href="edit-room.php?id=<?php echo $row->id;?>&property_id=<?php echo $_GET['property_id']; ?>&property_owner_id=<?php echo $_GET['property_owner_id']; ?>" title="Show Details"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
<a href="property-details.php?del=<?php echo $row->id;?>&property_id=<?php echo $_GET['property_id']; ?>&property_owner_id=<?php echo $_GET['property_owner_id']; ?>" title="Delete Room" onclick="return confirm("Do you want to delete");"><i class="fa fa-close"></i></a></td>
										</tr>
									<?php
$cnt=$cnt+1;
									 } ?>
											
										
									</tbody>
								</table>

								
							</div>
						</div>
						</div>


						<!--****************************************************************************************-->
						<div id="alltenants" style="display:none;">
						<div class="panel panel-default">
							<div class="panel-heading">All Property Tenants<label><a href="registration.php?property_id=<?php echo $_GET['property_id']; ?>&property_owner_id=<?php echo $_GET['property_owner_id']; ?>" style="margin-left:810px">Add New Tenant</a></label></div>
							<div class="panel-body">
									<table class="zctb display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>Sno.</th>
										
											<th>First Name</th>
											<th>Last Name</th>
											<th>Contact Number </th>

											<th>Email </th>
											<th>Action</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>Sno.</th>
											<th>First Name</th>
											<th>Last Name</th>
											<th>Contact Number </th>

											<th>Email </th>
											<th>Action</th>
										</tr>
									</tfoot>
									<tbody>
<?php	
$property_owner_id=$_GET['property_owner_id'];
$property_id=$_GET['property_id'];
$ret="select * from registration";
$stmt= $mysqli->prepare($ret) ;
//$stmt->bind_param('ii',$property_owner_id,$property_id);
$stmt->execute() ;//ok
$res=$stmt->get_result();
$cnt=1;
while($row=$res->fetch_object())
	  {
	  	?>
<tr><td><?php echo $cnt;?></td>
<td><?php echo $row->firstName;?></td>
<td><?php echo $row->lastName;?></td>
<td><?php echo $row->contactno;?></td>
<td><?php echo $row->emailid;?></td>
<td><a href="edit-room.php?id=<?php echo $row->id;?>&property_id=<?php echo $_GET['property_id']; ?>&property_owner_id=<?php echo $_GET['property_owner_id']; ?>" title="Show Details"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
<a href="property-details.php?dele=<?php echo $row->id;?>&property_id=<?php echo $_GET['property_id']; ?>&property_owner_id=<?php echo $_GET['property_owner_id']; ?>" title="Delete Tenant" onclick="return confirm("Do you want to delete");"><i class="fa fa-close"></i></a></td>
										</tr>
									<?php
$cnt=$cnt+1;
									 } ?>
											
										
									</tbody>
								</table>

								
							</div>
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

	<script type="text/javascript">
		function showrooms(){
			$("#allrooms").toggle();
			$("#hide").toggle();
			$("#show").toggle();
		}

		function showtenants(){
			$("#alltenants").toggle();
			$("#hide1").toggle();
			$("#show1").toggle();
		}
	</script>


</body>

</html>
