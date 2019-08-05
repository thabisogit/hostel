<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');

check_login();

//chec();

//function chec(){
//set_time_limit(0); // make it run forever
//echo "<script>alert('testing cron');</script>"; 
//while(true) {
//	echo "<script>alert('testing cron2');</script>"; 
    //doSomethingSpecial();
  //  sleep(10);
  //  echo "<script>alert('testing cron3');</script>"; 
//}

//}
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
	
	<title>DashBoard</title>
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
<?php include("includes/header.php");?>

	<div class="ts-main-content">
		<?php include("includes/sidebar.php");?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">

						<h2 class="page-title">Dashboard</h2>
						
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-3">
										<div class="panel panel-default">
											<div class="panel-body bk-primary text-light">
												<div class="stat-panel text-center">
													<div class="stat-panel-number h1 ">My Profile</div>													
												</div>
											</div>
											<a href="my-profile.php" class="block-anchor panel-footer">Full Detail <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>
									<div class="col-md-3">
										<div class="panel panel-default">
											<div class="panel-body bk-success text-light">
												<div class="stat-panel text-center">
												<div class="stat-panel-number h1 ">My Room</div>													
												</div>
											</div>
											<a href="room-details.php" class="block-anchor panel-footer text-center">See All &nbsp; <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>

									<div class="col-md-3">
										<div class="panel panel-default" style="width: 250px;">
											<div class="panel-body bk-warning text-light">
												<div class="stat-panel text-center">

												<div class="stat-panel-number h1 ">Notice Board</div>
													
												</div>
											</div>
											<a href="notice.php" class="block-anchor panel-footer text-center">See All Latest Notices &nbsp; <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>
							
								</div>

								<h3>Available Seats</h3>
																		<table id="zctb" class="zctb display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th style="text-align:center;">Sno.</th>
											<th>Location</th>
											<th style="text-align:center;">Room No.</th>
											<th style="text-align:center;">Seater</th>
											<th style="text-align:center;">Fees PM</th>
											<th style="text-align:center;">Available Seats</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th style="text-align:center;">Sno.</th>
											<th>Location</th>
											<th style="text-align:center;">Room No.</th>
											<th style="text-align:center;">Seater</th>
											<th style="text-align:center;">Fees PM</th>
											<th style="text-align:center;">Available Seats</th>
										</tr>
									</tfoot>
									<tbody>
<?php	
$id=intval($_SESSION['id']);

$cnt=1;
$stmt->close();
$ret="select * from (
select count(*) as ro, rooms.seater, rooms.room_no, rooms.location, 
(rooms.seater - count(*)) as available, rooms.fees
from registration
left join rooms on room_no = registration.roomno 
group by rooms.seater, rooms.room_no,rooms.location,rooms.fees) as main where main.available <> 0; ";
$stmt= $mysqli->prepare($ret) ;
//$stmt->bind_param('i',$id);
$stmt->execute() ;//ok
$res=$stmt->get_result();
$cnt=1;
while($row=$res->fetch_object())
	  {
	  	?>
<tr style="text-align:center;"><td><?php echo $cnt;?></td>
<td><?php echo $row->location;?></td>
<td><?php echo $row->room_no;?></td>
<td><?php echo $row->seater;?></td>
<td><?php echo $row->fees;?></td>
<td><?php echo $row->available;?></td>

										</tr>
									<?php
$cnt=$cnt+1;
									 } ?>
											
										
									</tbody>
								</table>

									<h3><label style="color:red">Empty Rooms</label> Available</h3>
																		<table id="zctb" class="zctb display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th style="text-align:center;">Sno.</th>
											<th>Location</th>
											<th style="text-align:center;">Room No.</th>
											<th style="text-align:center;">Seater</th>
											<th style="text-align:center;">Fees PM</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th style="text-align:center;">Sno.</th>
											<th>Location</th>
											<th style="text-align:center;">Room No.</th>
											<th style="text-align:center;">Seater</th>
											<th style="text-align:center;">Fees PM</th>
										</tr>
									</tfoot>
									<tbody>
<?php	
$id=intval($_SESSION['id']);

$cnt=1;
$stmt->close();
$ret="select * from rooms where room_no not in(select room_no from (
select count(*) as ro, rooms.seater, rooms.room_no, rooms.location, 
(rooms.seater - count(*)) as available, rooms.fees
from registration
left join rooms on room_no = registration.roomno 
group by rooms.seater, rooms.room_no,rooms.location,rooms.fees) as main);";
$stmt= $mysqli->prepare($ret) ;
//$stmt->bind_param('i',$id);
$stmt->execute() ;//ok
$res=$stmt->get_result();
$cnt=1;
while($row=$res->fetch_object())
	  {
	  	?>
<tr style="text-align:center;"><td><?php echo $cnt;?></td>
<td><?php echo $row->location;?></td>
<td><?php echo $row->room_no;?></td>
<td><?php echo $row->seater;?></td>
<td><?php echo $row->fees;?></td>

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
	
	<script>
		
	window.onload = function(){
    
		// Line chart from swirlData for dashReport
		var ctx = document.getElementById("dashReport").getContext("2d");
		window.myLine = new Chart(ctx).Line(swirlData, {
			responsive: true,
			scaleShowVerticalLines: false,
			scaleBeginAtZero : true,
			multiTooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>",
		}); 
		
		// Pie Chart from doughutData
		var doctx = document.getElementById("chart-area3").getContext("2d");
		window.myDoughnut = new Chart(doctx).Pie(doughnutData, {responsive : true});

		// Dougnut Chart from doughnutData
		var doctx = document.getElementById("chart-area4").getContext("2d");
		window.myDoughnut = new Chart(doctx).Doughnut(doughnutData, {responsive : true});

	}
	</script>

</body>

</html>