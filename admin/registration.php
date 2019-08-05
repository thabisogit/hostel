<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();
//code for registration

if(isset($_POST['submit']))
{
// prepare and bind
$stmt = $conn->prepare("INSERT INTO tenantregistration(id_number,name,surname,contact_no,email,room_no,property_id,property_owner_id,deleted) VALUES (?,?,?,?,?,?,?,?)");
$stmt->bind_param('ssssssssi',$id_number,$fname,$lname,$contactno,$email,$roomno,$property_id,$property_owner_id,$deleted);

// set parameters and execute
$id_number=$_POST['idno'];
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$contactno=$_POST['contactno'];
$email=$_POST['email'];
$roomno=$_POST['roomno'];
$property_id = $_GET['property_id'];
$property_owner_id = $_GET['property_owner_id'];
$deleted='0';
$stmt->execute();

echo"<script>alert('Succssfully Registered');</script>";

//saveBank();

$stmt->close();
$conn->close();

//$stmt = $conn->prepare("INSERT INTO MyGuests (firstname, lastname, email) VALUES (?, ?, ?)");
}
/*if(isset($_POST['submit']))
{
$roomno=$_POST['room'];
$location=$_POST['location'];
$seater=$_POST['seater'];
$feespm=$_POST['fpm'];
$foodstatus=$_POST['foodstatus'];
$stayfrom=$_POST['stayf'];
$duration=$_POST['duration'];
$course=$_POST['course'];
$regno=$_POST['regno'];
$fname=$_POST['fname'];
$mname=$_POST['mname'];
$lname=$_POST['lname'];
$gender=$_POST['gender'];
$contactno=$_POST['contact'];
$emailid=$_POST['email'];
$emcntno=$_POST['econtact'];
$gurname=$_POST['gname'];
$gurrelation=$_POST['grelation'];
$gurcntno=$_POST['gcontact'];
$caddress=$_POST['address'];
$ccity=$_POST['city'];
$cstate=$_POST['state'];
$cpincode=$_POST['pincode'];
$paddress=$_POST['paddress'];
$pcity=$_POST['pcity'];
$pstate=$_POST['pstate'];
$ppincode=$_POST['ppincode'];
$query="insert into  registration(roomno,seater,feespm,foodstatus,stayfrom,duration,course,regno,firstName,middleName,lastName,gender,contactno,emailid,egycontactno,guardianName,guardianRelation,guardianContactno,corresAddress,corresCIty,corresState,corresPincode,pmntAddress,pmntCity,pmnatetState,pmntPincode,location) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$stmt = $mysqli->prepare($query);
echo "<pre>".print_r($query,true)."</pre>";
$rc=$stmt->bind_param('iiiisisissssisississsisssis',$roomno,$seater,$feespm,$foodstatus,$stayfrom,$duration,$course,$regno,$fname,$mname,$lname,$gender,$contactno,$emailid,$emcntno,$gurname,$gurrelation,$gurcntno,$caddress,$ccity,$cstate,$cpincode,$paddress,$pcity,$pstate,$ppincode,$location);

$stmt->execute();
$stmt->close();
echo"<script>alert('Student Succssfully register');</script>";
}*/
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
	<title>Student Hostel Registration</title>
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
$('#seater').val(data);
}
});

$.ajax({
type: "POST",
url: "get_seater.php",
data:'rid='+val,
success: function(data){
$('#fpm').val(data);
}
});

checkAvailability();
}

function getRooms(val) {
	
$.ajax({
type: "POST",
url: "get_seater.php",
data:'location='+val,
success: function(data){
$('#room').empty();
var defaultSelect = "<option>Select</option>";
$('#room').append(defaultSelect);
$('#room').append(data);
}
});
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
					
						<h2 class="page-title">Registration </h2>

						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-primary">
									<div class="panel-heading">Fill all Info</div>
									<div class="panel-body">
										<form method="post" action="" class="form-horizontal">
											
										
<div class="form-group">
<label class="col-sm-4 control-label"><h4 style="color: green" align="left">Room Related info </h4> </label>
</div>


<!-- <div class="form-group">
	<label class="col-sm-2 control-label">Select Location</label>
													<div class="col-sm-8">
													<Select name="location" class="form-control" onChange="getRooms(this.value);" required>
													<option value="">Select Location</option>
	<?php
	 //$ret="select concat(city,' ',surbub,' ',line1,' ',line2,' ',line3,' ',pcode) As Location from locations;";
	//$stmt= $mysqli->prepare($ret) ;
	//$stmt->bind_param('i',$aid);
	//$stmt->execute() ;//ok
	//$res=$stmt->get_result();
	//$cnt=1;
	//while($row=$res->fetch_object())
		  {
		  	?>
	<option value="<?php //echo $row->Location;?>"><?php //echo $row->Location;?></option>
										<?php
										 } ?>

	</Select>
	</div>
	</div> -->

	<div class="form-group">
	<label class="col-sm-2 control-label">Room no.</label>
													<div class="col-sm-8">
													<Select name="roomno" class="form-control" onChange="getSeater(this.value);" required>
													<option value="">Select Room</option>
	<?php
	 $ret="select room_no from rooms where property_id = ? and property_owner_id = ?";
	$stmt= $mysqli->prepare($ret) ;
	$stmt->bind_param('ii',$property_id,$property_owner_id);
	$stmt->execute() ;//ok
	$res=$stmt->get_result();
	//$cnt=1;
	while($row=$res->fetch_object())
		  {
		  	?>
	<option value="<?php echo $row->room_no;?>"><?php echo $row->room_no;?></option>
										<?php
										 } ?>

	</Select>
	<span id="room-availability-status" style="font-size:12px;"></span>
	</div>
	</div>

<!-- <div class="form-group">
<label class="col-sm-2 control-label">Room no. </label>


<div class="col-sm-8">
<select name="room" id="room"class="form-control"  onChange="getSeater(this.value);" onBlur="" required> 
<option value="">Select Room</option>
</select> 
<span id="room-availability-status" style="font-size:12px;"></span>

</div>
</div> -->

<div class="form-group">
<label class="col-sm-2 control-label">Seater</label>
<div class="col-sm-8">
<input type="text" readonly="readonly" name="seater" id="seater"  class="form-control"  >
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Fees Per Month</label>
<div class="col-sm-8">
<input type="text" readonly="readonly" name="fpm" id="fpm"  class="form-control" >
</div>
</div>
<!-- 
<div class="form-group">
<label class="col-sm-2 control-label">Food Status</label>
<div class="col-sm-8">
<input type="radio" value="0" name="foodstatus" checked="checked"> Without Food
<input type="radio" value="1" name="foodstatus"> With Food(Rs 2000.00 Per Month Extra)
</div>
</div>	
 -->
<div class="form-group">
<label class="col-sm-2 control-label">Stay From</label>
<div class="col-sm-8">
<input type="date" name="stayf" id="stayf"  class="form-control" >
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Duration</label>
<div class="col-sm-8">
<select name="duration" id="duration" class="form-control">
<option value="">Select Duration in Month</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
</select>
</div>
</div>


<div class="form-group">
<label class="col-sm-2 control-label"><h4 style="color: green" align="left">Personal info </h4> </label>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">First Name : </label>
<div class="col-sm-8">
<input type="text" name="fname" id="fname"  class="form-control" required="required" >
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Last Name : </label>
<div class="col-sm-8">
<input type="text" name="lname" id="lname"  class="form-control" required="required">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">ID Number : </label>
<div class="col-sm-8">
<input type="text" name="idno" id="idno"  class="form-control" required="required" >
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Contact No : </label>
<div class="col-sm-8">
<input type="text" name="contactno" id="contactno"  class="form-control" required="required">
</div>
</div>


<div class="form-group">
<label class="col-sm-2 control-label">Email : </label>
<div class="col-sm-8">
<input type="email" name="email" id="email"  class="form-control" required="required">
</div>
</div>


<div class="form-group">
<label class="col-sm-2 control-label"><h4 style="color: green" align="left">Occupants info </h4> </label>
</div>



<!--******************************************************************************************************** -->
<div id="main" class="main">
        <div class="my-form">
            <form role="form" method="post">
                <p class="text-box">
                    <label for="box1">Occupant <span class="box-number">1</span></label> 
                    	<input type="text" name="boxes[]" class="form-control1" placeholder="Enter Name" value="" style="width:200px" id="box1" />
                    	<input type="text" name="ocontact[]" class="form-control1" placeholder="Enter Contact No." value="" style="width:200px" id="ocontact1" /> 

                    <a class="add-box" href="#">Add More</a>
                </p>
            </form>
        </div>
        <a class="add-box" href="#">Add More</a>
    </div>
    

<div class="col-sm-6 col-sm-offset-4">
<button class="btn btn-default" type="submit">Cancel</button>
<input type="submit" name="submit" Value="Register" class="btn btn-primary">
</div>	
<!-- <div class="form-group">
<label class="col-sm-2 control-label">Middle Name : </label>
<div class="col-sm-8">
<input type="text" name="mname" id="mname"  class="form-control">
</div>
</div> -->


<!-- <div class="form-group">
<label class="col-sm-2 control-label">Gender : </label>
<div class="col-sm-8">
<select name="gender" class="form-control" required="required">
<option value="">Select Gender</option>
<option value="male">Male</option>
<option value="female">Female</option>
<option value="others">Others</option>
</select>
</div>
</div> -->


<!-- <div class="form-group">
<label class="col-sm-2 control-label">Emergency Contact: </label>
<div class="col-sm-8">
<input type="text" name="econtact" id="econtact"  class="form-control" required="required">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Guardian  Name : </label>
<div class="col-sm-8">
<input type="text" name="gname" id="gname"  class="form-control" required="required">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Guardian  Relation : </label>
<div class="col-sm-8">
<input type="text" name="grelation" id="grelation"  class="form-control" required="required">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Guardian Contact no : </label>
<div class="col-sm-8">
<input type="text" name="gcontact" id="gcontact"  class="form-control" required="required">
</div>
</div>	

<div class="form-group">
<label class="col-sm-3 control-label"><h4 style="color: green" align="left">Correspondense Address </h4> </label>
</div>


<div class="form-group">
<label class="col-sm-2 control-label">Address : </label>
<div class="col-sm-8">
<textarea  rows="5" name="address"  id="address" class="form-control" required="required"></textarea>
</div>
</div> -->
						

<!-- <div class="form-group">
<label class="col-sm-2 control-label">Pincode : </label>
<div class="col-sm-8">
<input type="text" name="pincode" id="pincode"  class="form-control" required="required">
</div>
</div>	

<div class="form-group">
<label class="col-sm-3 control-label"><h4 style="color: green" align="left">Permanent Address </h4> </label>
</div>


<div class="form-group">
<label class="col-sm-5 control-label">Permanent Address same as Correspondense address : </label>
<div class="col-sm-4" style="margin-top: 13px; margin-left: -20px;">
<input type="checkbox" name="adcheck" value="1"/>
</div>
</div>


<div class="form-group">
<label class="col-sm-2 control-label">Address : </label>
<div class="col-sm-8">
<textarea  rows="5" name="paddress"  id="paddress" class="form-control" required="required"></textarea>
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">City : </label>
<div class="col-sm-8">
<input type="text" name="pcity" id="pcity"  class="form-control" required="required">
</div>
</div>	

<div class="form-group">
<label class="col-sm-2 control-label">State </label>
<div class="col-sm-8">
<select name="pstate" id="pstate"class="form-control" required> 
<option value="">Select State</option>
<?php $query //="SELECT * FROM states";
//$stmt2 = $mysqli->prepare($query);
//$stmt2->execute();
//$res=$stmt2->get_result();
//while($row=$res->fetch_object())
//{

//?>
<option value="<?php //echo $row->State;?>"><?php //echo $row->State;?></option>
//<?php //} ?>
</select> </div>
</div>							
 -->
<!-- <div class="form-group">
<label class="col-sm-2 control-label">Pincode : </label>
<div class="col-sm-8">
<input type="text" name="ppincode" id="ppincode"  class="form-control" required="required">
</div>
</div>	 -->

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

<script type="text/javascript">
    jQuery(document).ready(function($){
        $('.main .add-box').click(function(){
            var n = $('.text-box').length + 1;
            if( 5 < n ) {
                alert('Stop it!');
                return false;
            }
            var box_html = $('<p class="text-box"><label for="box' + n + '">Occupant <span class="box-number">' + n + '</span></label> <input type="text" name="boxes[]" class="form-control1" placeholder="Enter Name" value="" style="width:200px" id="box' + n + '" /> <input type="text" name="ocontact[]" class="form-control1" placeholder="Enter Contact No." value="" style="width:200px" id="ocontact' + n + '" /> <a href="#" class="remove-box">Remove</a></p>');
            box_html.hide();
            $('.my-form p.text-box:last').after(box_html);
            box_html.fadeIn('slow');
            return false;
        });
        $('.my-form').on('click', '.remove-box', function(){
            $(this).parent().css( 'background-color', '#FF6C6C' );
            $(this).parent().fadeOut("slow", function() {
                $(this).remove();
                $('.box-number').each(function(index){
                    $(this).text( index + 1 );
                });
            });
            return false;
        });
    });
    </script>

</html>