<div class="brand clearfix">
		<a href="#" class="logo" style="font-size:15px;">Property Management System</a>
		<span class="menu-btn"><i class="fa fa-bars"></i></span>
		<ul class="ts-profile-nav">

				<?php 
$result ="SELECT count(*) from hostel.complaints where (resp = 0 or resp is null)";
$stmt = $mysqli->prepare($result);
//$stmt->bind_param('i',$ai);
$stmt->execute();
$stmt -> bind_result($result);
$stmt -> fetch(); 
$stmt->close();
if($result > 0){?>

		<li><a href="view-complaints.php?not=1" style="display:table-cell; padding:10px;" title="Tenants complaints"><i class="fa fa-globe"></i>&nbsp;<label style="color:red"><?php echo $result;?></label></a>
		<?php } ?>

						<?php 
$result ="SELECT count(*) from hostel.roommate_requests where accepted is null;";
$stmt = $mysqli->prepare($result);
//$stmt->bind_param('i',$ai);
$stmt->execute();
$stmt -> bind_result($result);
$stmt -> fetch(); 
$stmt->close();
if($result > 0){?>

		<li><a href="view-roommate-requests.php?not=1"  style="display:table-cell; padding:10px;"  title="Room-mates Requests"><i class="fa fa-globe"></i>&nbsp;<label style="color:red"><?php echo  $result;?></label></a>
		<?php } ?>

			<li class="ts-account">
				<a href="#" style="height:50px;"><img src="img/ts-avatar.jpg" class="ts-avatar hidden-side" alt=""> Account <i class="fa fa-angle-down hidden-side"></i></a>
				<ul>
					<li><a href="admin-profile.php">My Account</a></li>
					<li><a href="logout.php">Logout</a></li>
				</ul>
			</li>
		</ul>
	</div>