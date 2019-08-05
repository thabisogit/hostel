<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();
//code for registration
if(isset($_POST['submit']))
{
$name=$_POST['name'];
$address=$_POST['address'];
$id=$_GET['id'];

$query="insert into  property(property_name,address,property_owner_id) values(?,?,?)";
$stmt = $mysqli->prepare($query);
$rc=$stmt->bind_param('ssi',$name,$address,$id);
$stmt->execute();
$stmt->close();

echo"<script>alert('Property added Succssfully');</script>";
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
	<title>Property Registration</title>
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<link rel="stylesheet" href="css/fileinput.min.css">
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<link rel="stylesheet" href="css/style.css">
<script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
<script type="text/javascript" src="js/validation.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
<script>
function getSeater(val) {
$.ajax({
type: "POST",
url: "get_seater.php",
data:'roomid='+val,
success: function(data){
//alert(data);
$('#seater').val(data);
}
});

checkAvailability();
}

</script>

</head>
<body>
	<?php include('includes/header.php');?>
	<div class="ts-main-content">
		<?php include('includes/sidebar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">
					
					<?php	
$id=$_GET['property_owner_id'];
$ret="select * from property_owners where id=?";
$stmt= $mysqli->prepare($ret) ;
$stmt->bind_param('i',$id);
$stmt->execute() ;//ok
$res=$stmt->get_result();
$cnt=1;
while($row=$res->fetch_object())
	  {?>
	  	<h2 class="page-title" style="margin-top:25px;"><?php echo $row->name?> Properties </h2>

	  	<?php }
	  	?>

						

						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-primary">
									<div class="panel-heading">List of Properties</div>
									<div class="panel-body">
										<form method="post" action="" class="form-horizontal">
											<div id="list">
											
<?php $id=$_GET['property_owner_id'];
$ret="select * from property where property_owner_id=?";
$stmt= $mysqli->prepare($ret) ;
$stmt->bind_param('i',$id);
$stmt->execute() ;//ok
$res=$stmt->get_result();
$cnt=1;

$result ="SELECT count(*) from hostel.property where (property_owner_id = ? or property_owner_id is null)";
$stmt = $mysqli->prepare($result);
$stmt->bind_param('i',$id);
$stmt->execute();
$stmt -> bind_result($result);
$stmt -> fetch(); 
$stmt->close();
if($result > 0){

		while($row=$res->fetch_object())
	  {
	  	?>

	  	<div class="form-group">
<label class="col-sm-4 control-label"><h4 style="color: green;margin-bottom:-20px;" align="left"><a style="color: green;margin-bottom:-20px;" align="left" href="/hostel/admin/property-details.php?property_id=<?php echo $row->id; ?>&property_owner_id=<?php echo $_GET['property_owner_id'] ?>"><?php echo $row->property_name; ?> </a></h4> </label>
</div>

	  	

		<?php }}else{
			echo "No properties for this owner";
		}
	  	?>							
</div>

<div style="display:none" id="addform">
<div class="form-group">
<label class="col-sm-2 control-label">Property Name</label>
<div class="col-sm-8">
<input type="text" name="name" id="name"  class="form-control"  required>
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Address : </label>
<div class="col-sm-8">
<textarea  rows="5" name="address"  id="address" class="form-control" required="required"></textarea>
</div>
</div>

<div>
<button class="btn btn-default"  onclick="hideform()"  type="button">Cancel</button>
<input type="submit" name="submit" Value="Add New Property" class="btn btn-primary">
</div>

</div>

<br />
<div>
<button class="btn btn-default" id="showbtn" onclick="showform()" type="button">Add New Property</button>
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
</body>
<script type="text/javascript">
	$(document).ready(function(){
        $('input[type="checkbox"]').click(function(){
            if($(this).prop("checked") == true){
                $('#paddress').val( $('#address').val() );
                $('#pcity').val( $('#city').val() );
                $('#pstate').val( $('#state').val() );
                $('#ppincode').val( $('#pincode').val() );
            } 
            
        });
    });
</script>
	<script>

	function showform(){
		$("#addform").show();
		$("#showbtn").hide();
		$("#list").hide();
		
	}

	function hideform(){
		$("#addform").hide();
		$("#showbtn").show();
		$("#list").show();
	}
function checkAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'roomno='+$("#room").val(),
type: "POST",
success:function(data){
$("#room-availability-status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>

</html>