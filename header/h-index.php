<html>
<head>

<link href="css/font.css" rel="stylesheet" type="text/css" 	>
<link href="css/default.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" type="text/css" href="css/animate-custom.css" />
<link href="css/drop.css" type="text/css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/all.min.css">

<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="js/all.min.js"></script>

</head>

<body oncontextmenu="return false">
<?php 
	include('user/config.php');
	$cat = mysqli_query($mysqli,"SELECT * FROM Categories");
?>
<div id="wrapper-bg">
	<div class="icon">
	<a href="" target="new">	<i class="fab fa-facebook-square" style="color: #FFF; font-size:20px; margin: 5px 20px 5px 5px; float: right;"></i></a>
	
		<i class="fab fa-instagram" style="color:#FFF; font-size:20px; margin: 5px; float:right;"></i>

		<i class="fab fa-twitter" style="color:#fff; font-size:20px; margin: 5px; float: right;"></i>
		<i class="fab fa-google-plus-g" style="color: #fff; font-size:20px; margin: 5px; float: right;"></i>
	</div>
	<div id="wrapper">
		<div id="header" class="container">
			<div id="logo">
				<h1><a href="index.php"><span>News</span>Portal</a></h1>
			</div>
			<div id="menu">
				<ul>
					<li class="active"><a href="index.php" title="Account">Home</a></li>
					<li class="dropdown"><a> Categories</a>
						<div class="dropdown-content">
						<?php
							while($row=mysqli_fetch_assoc($cat)) 
							{	?>
							<a href="categories.php?id=<?php echo $row['ID'];?>" title="<?php echo $row['Categories_Type'];?>"><?php echo $row['Categories_Type'];?></a>
							<?php }?>
						</div>
					</li>
					<li><a href="account.php" title="Account">Account</a></li>
				</ul>
			</div>
		</div>
	<div>
	</div>
	</div>
	</div>
</body>
</html>
	