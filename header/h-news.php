<html>
<head>

<link href="../css/font.css" rel="stylesheet" type="text/css">
<link href="../css/default.css" rel="stylesheet" type="text/css" media="all" />
<link href="../css/drop.css" type="text/css" rel="stylesheet">
<link href="../css/profile.css" rel="stylesheet" type="text/css">

</head>

<body oncontextmenu="return false">
<?php 
	include('config.php');
	$cat = mysqli_query($mysqli,"SELECT * FROM Categories");
?>
<div id="wrapper-bg">
	<div id="wrapper">
		<div id="header" class="container">
			<div id="logo">
				<h1><a href="home.php"><span>News</span>Portal</a></h1>
			</div>
			<div id="menu">
				<ul>
					<li><a href="home.php" title="Home">Home</a></li>
					<li class="dropdown"><a> Categories</a>
						<div class="dropdown-content">
						<?php
							while($row=mysqli_fetch_assoc($cat)) 
							{	?>
							<a href="categories.php?id=<?php echo $row['ID'];?>" title="<?php echo $row['Categories_Type'];?>"><?php echo $row['Categories_Type'];?></a>
							<?php }?>
					
						</div>
					</li>
					<li class=""><a href="pricing.php" title="Pricing">Pricing</a></li>
					<li class="active"><a href="news.php" title="Request for News">Request for News</a></li>
					<li class="dropdown chip"><a href="<?php echo "../".$_SESSION['i_path']; ?>"> <img src="<?php echo "../".$_SESSION['i_path']; ?>"><?php echo $_SESSION['user_name']; ?></a>
						<div class="dropdown-content">
							<a href="feedback.php" title="Feedback">Feedback</a>
							<a href="edit_profile.php" title="Edit Profile">Edit Profile</a>
							<a href="logout.php" title="Logout">Logout</a>
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