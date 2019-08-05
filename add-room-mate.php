	<?php
	session_start();
	include('includes/config.php');
	include('includes/checklogin.php');
	check_login();
	//code for add courses
	//checkdates();
	if(isset($_POST['submit']))
	{
		$userid=$_SESSION['id'];	
		$no_mates=$_POST['mates'];
		$no_days=$_POST['days'];
		$stayfrom=$_POST['stayfrom'];
		$fees=$_POST['fees'];
		$summary=$_POST['summary'];
		$query="insert into roommate_requests (no_mates,no_days,total_fees,userid,summary,stay_from_date) values(?,?,?,?,?,?)";
		$stmt = $mysqli->prepare($query);
		$rc=$stmt->bind_param('iidiss',$no_mates,$no_days,$fees,$userid,$summary,$stayfrom);
		$stmt->execute();
		echo"<script>alert('Request has been added successfully');</script>";
	}

	if(isset($_GET['del']))
	{
		$id=intval($_GET['del']);
		$adn="delete from roommate_requests where id=?";
		$stmt= $mysqli->prepare($adn);
		$stmt->bind_param('i',$id);
		$stmt->execute();
		$stmt->close();	   
		echo "<script>alert('Request Deleted');</script>" ;
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

											<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
												<thead>
													<tr>
														<th style="text-align:center;">Sno.</th>
														<th>Note</th>
														<th style="text-align:center;">No. of Mates</th>
														<th style="text-align:center;">No. of Days</th>
														<th style="text-align:center;">Stay From</th>
														<th style="text-align:center;">Total Fees</th>
														<th style="text-align:center;">Accepted</th>
														<th style="text-align:center;">Action</th>
													</tr>
												</thead>
												<tfoot>
													<tr>
														<th style="text-align:center;">Sno.</th>
														<th>Note</th>
														<th style="text-align:center;">No. of Mates</th>
														<th style="text-align:center;">No. of Days</th>
														<th style="text-align:center;">Stay From</th>
														<th style="text-align:center;">Total Fees</th>
														<th style="text-align:center;">Accepted</th>
														<th style="text-align:center;">Action</th>
													</tr>
												</tfoot>
												<tbody>
													<?php	
													$id=intval($_SESSION['id']);

													$cnt=1;
													$stmt->close();
													$ret="select * from roommate_requests where userid=?";
													$stmt= $mysqli->prepare($ret) ;
													$stmt->bind_param('i',$id);
$stmt->execute() ;//ok
$res=$stmt->get_result();
$cnt=1;
while($row=$res->fetch_object())
{
	?>
	<tr><td style="text-align:center;"><?php echo $cnt;?></td>
		<td><?php echo $row->summary;?></td>
		<td><?php echo $row->no_mates;?></td>
		<td><?php echo $row->no_days;?></td>
		<td><?php echo $row->stay_from_date;?></td>
		<td><?php echo $row->total_fees	;?></td>
		<td style="text-align:center;"><a href="view-response.php?id=<?php echo $row->id;?>" style="text-align:center;<?=($row->accepted == '0') ? "color: red" : "color: green" ?>"><?=($row->accepted == '0') ? "Rejected" : "Accepted" ?></a></td>
		<td style="text-align:center;">
			<a href="view-roommate-response.php?id=<?php echo $row->id;?>" title="View Response"><i class="fa fa-desktop"></i></a>&nbsp;
			<a href="add-room-mate.php?del=<?php echo $row->id;?>" title="Delete Request" onclick="return confirm("Do you want to delete");"><i class="fa fa-close"></i></a></td>
		</tr>
		<?php
		$cnt=$cnt+1;
	} ?>


</tbody>
</table>

<?php if(isset($_POST['submit']))
{ ?>
	
	<?php } ?>
	<form method="post" class="form-horizontal">

		<div class="hr-dashed"></div>

		<?php
		$stmt->close();
	//$aid = $_SESSION['id'];
	 //$ret="select * from roommate_requests where userid=? and (accepted is null or accepted = '');";

		$userid = $_SESSION['id'];
//$stmt->close();
		$result ="select userid from roommate_requests where userid=? and (accepted is null or accepted = '')";
		$stmt = $mysqli->prepare($result);
		$stmt->bind_param('s',$userid);
		$stmt->execute();
		$stmt -> bind_result($result);
		$stmt -> fetch();
//echo $result;exit;
		if(!$result == "") {
			echo "<span style='color:red;margin-left:250px;'> Please wait until the above request is accepted and completed!</span>";
		}

		else{ 
			?>
			<div class="form-group">
				<label class="col-sm-2 control-label">No. of room mates</label>
				<div class="col-sm-8">
					<Select name="mates" id="mates" class="form-control" onChange="calc(this.value);" required>

						<?php
						$stmt->close();
						$ret="select no_mates from roommates;";
						$stmt= $mysqli->prepare($ret) ;
	//$stmt->bind_param('i',$aid);
	$stmt->execute();//ok
	$res=$stmt->get_result();
	$cnt=1;
	$cnt2=1;
	//$stmt->close();
	while($row=$res->fetch_object())
	{
		?>

		<?php 
		do {?>
		<option value="<?php echo $cnt;?>"><?php echo $cnt;?></option>

		<?php $cnt++; } while ( $cnt <= $row->no_mates);
		?>	

	</Select>
	<?php
} ?>
</div>
</div>


<div class="form-group">
	<label class="col-sm-2 control-label">No. of days </label>


	<div class="col-sm-8">
		<select name="days" id="days"class="form-control"  onChange="calc2(this.value);" onBlur="" required> 
			<?php
			$stmt->close();
			$ret="select no_days from roommates;";
			$stmt= $mysqli->prepare($ret) ;
	//$stmt->bind_param('i',$aid);
	$stmt->execute();//ok
	$res=$stmt->get_result();
	$cnt=1;
	$cnt2=1;
	//$stmt->close();
	while($row=$res->fetch_object())
	{
		?>

		<?php 
		do {?>
		<option value="<?php echo $cnt;?>"><?php echo $cnt;?></option>

		<?php $cnt++; } while ( $cnt <= $row->no_days);
		?>	

	</Select>
	<?php
} ?>
<span id="room-availability-status" style="font-size:12px;"></span>

</div>
</div>

<?php
$stmt->close();
$userid = $_SESSION['id'];
$ret="select fees_perday from roommates;";
$stmt= $mysqli->prepare($ret) ;
	//$stmt->bind_param('i',$aid);
	$stmt->execute();//ok
	$res=$stmt->get_result();
	$cnt=1;
	$cnt2=1;
	//$stmt->close();
	while($row=$res->fetch_object())
	{
		?>

		<div class="form-group">
			<label class="col-sm-2 control-label">Stay From: </label>
			<div class="col-sm-8">
				<input type="date" name="stayfrom" id="stayfrom" onBlur="checkdates(this.value)" class="form-control" required="required">
				<label id="warning" style="color:red;display:none">You can only book dates before your moving out date</label>
				<label id="warning2" style="color:red;display:none">You cannot book the dates before the current date</label>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label">Total Fees : </label>
			<div class="col-sm-8">
				<input type="text" name="fees"  id="fees" class="form-control" value="" required="required" readonly />
				<input type="hidden" name="feesTotal"  id="feesTotal" class="form-control" value="<?php echo $row->fees_perday;?>" readonly />
				<input type="hidden" name="userid"  id="userid" class="form-control" value="<?php echo $userid;?>" readonly />
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
			<input class="btn btn-primary" type="submit" id="savebtn" name="submit" value="Add Request ">
		</div>
	</div>
	<?php } ?>
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
	function checkdates(val) {

			//alert('thabisongubane');
			var days = $("#days").val();
			var userid = $("#userid").val();
			//alert(userid);
			$.ajax({
				type: "POST",
				url: "get_seater.php",
				data:'staydate='+val+'&days='+days+'&userid='+userid,
		//data2:'days='+days,
		success: function(data){
			//alert(data);
			if(data == 1){
				$('#savebtn').hide();
				$('#warning').show();
				$('#stayfrom').val('');
			}else if(data == 3){
				$('#savebtn').hide();
				$('#warning2').show();
				$('#stayfrom').val('');
			}else{
				$('#warning').hide();
				$('#warning2').hide();
				$('#savebtn').show();
			}

		}
	});
		}

		function checkdates2(val) {

			var date = $("#stayfrom").val();
			$.ajax({
				type: "POST",
				url: "get_seater.php",
				data:'staydate='+date+'&days='+val,
				success: function(data){
		//alert(data);
	}
});
		}

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
			$('#stayfrom').val('');
			checkdates2(t);
		}

	</script>
</body>

</html>