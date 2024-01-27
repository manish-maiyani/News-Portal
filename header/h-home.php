<html>

<head>

<link href="../css/font.css" rel="stylesheet" type="text/css">
<link href="../css/default.css" rel="stylesheet" type="text/css" media="all" />
<link href="../css/drop.css" type="text/css" rel="stylesheet">
<link href="../css/profile.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="../css/all.min.css">

<script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="../js/all.min.js"></script>
</head>

<body oncontextmenu="return false">
<?php 
	include('config.php');
	$cat = mysqli_query($mysqli,"SELECT * FROM Categories");

	$pay_sql = "select * from payment where UDF1=".$_SESSION['user_id'];
	$res_pay = mysqli_query($mysqli,$pay_sql);
	$cnt = mysqli_num_rows($res_pay);
?>
<div id="wrapper-bg">
	<div class="icon">
	<a href="https://www.facebook.com/creativewebmultimedia/" target="new">	<i class="fab fa-facebook-square" style="color: #fff; font-size:20px; margin: 5px 20px 5px 5px; float: right;"></i></a>
	
		<i class="fab fa-instagram" style="color:#fff;font-size:20px; margin: 5px; float:right;"></i>

		<i class="fab fa-twitter" style="color:#fff; font-size:20px; margin: 5px; float: right;"></i>
		<i class="fab fa-google-plus-g" style="color: #fff; font-size:20px; margin: 5px; float: right;"></i>
	</div>
	<div id="wrapper">
		<div id="header" class="container">
			<div id="logo">
				<h1><a href="home.php"><span>News</span>Portal</a></h1>
			</div>
			
			<div id="menu">
				<ul>
					<li class="active"><a href="home.php" title="Home">Home</a></li>
					<li class="dropdown"><a> Categories</a>
						<div class="dropdown-content">
						<?php
							while($row=mysqli_fetch_assoc($cat)) 
							{	?>
							<a href="categories.php?id=<?php echo $row['ID'];?>" title="<?php echo $row['Categories_Type'];?>"><?php echo $row['Categories_Type'];?></a>
							<?php }?>
						</div>
					</li>
					<?php
						if($cnt==0){
							?>
								<li><a href="pricing.php" title="Pricing">Pricing</a></li>
							<?php
						}else{
							?>
								<li class="dropdown"><a> Advertise</a>
									<div class="dropdown-content">
									
										<a href="add_advertise.php">Add Advertise</a>
										<a href="advertise_details.php">View Advertise</a>
									</div>
								</li>
							<?php
						}
					?>
					
					<li><a href="news.php" title="Request for News">Request for News</a></li>
					
					<li class="dropdown chip"><a href="<?php echo "../".$_SESSION['i_path']; ?>"> <img src="<?php echo "../".$_SESSION['i_path']; ?>" ><?php echo $_SESSION['user_name']; ?></a>
						<div class="dropdown-content">
						    <a href="feedback.php" title="Feedback">Feedback</a>

							<a href="edit_profile.php" title="Edit Profile">Edit Profile</a>
							<a href="logout.php" name="logout" title="Logout">Logout</a>
						</div>
					</li>
					
				</ul>
			</div>
			
		</div>
		<div>
		</div>
	</div>
	</div>
</body>
</html>