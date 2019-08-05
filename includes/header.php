<?php if($_SESSION['id'])
{ echo "<pre>".print_r($_SESSION['id'],true)."</pre>"; ?><div class="brand clearfix">
		<a href="#" class="logo" style="font-size:15px;">Property Management System</a>
		<span class="menu-btn"><i class="fa fa-bars"></i></span>
		<ul class="ts-profile-nav">

		<?php 
		$ai = $_SESSION['id'];
$result ="SELECT count(*) from hostel.complaints where resp = 1 and (seen = 0 or seen is null) and userid=?";
$stmt = $mysqli->prepare($result);
$stmt->bind_param('i',$ai);
$stmt->execute();
$stmt -> bind_result($result);
$stmt -> fetch(); 

if($result > 0){?>

		<li><a href="view-complaints.php?not=1"><i class="fa fa-globe"></i>&nbsp;<label style="color:red"><?php echo $result;?></label></a>
		<?php } ?>
			<li class="ts-account">
				<a href="#"><img src="img/ts-avatar.jpg" class="ts-avatar hidden-side" alt=""> Account <i class="fa fa-angle-down hidden-side"></i></a>
				<ul>
					<li><a href="my-profile.php">My Account</a></li>
					<li><a href="logout.php">Logout</a></li>
				</ul>
			</li>
		</ul>
	</div>

<?php
} else { ?>
<div class="brand clearfix">
		<a href="#" class="logo" style="font-size:16px;">Property Management System</a>
		<span class="menu-btn"><i class="fa fa-bars"></i></span>
		
	</div>
	<?php } ?>