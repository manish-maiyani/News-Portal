<html>
<head>

<link href="css/font.css" rel="stylesheet" type="text/css" 	>
<link href="css/default.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" type="text/css" href="css/animate-custom.css" />
<link href="css/drop.css" type="text/css" rel="stylesheet">

</head>

<body oncontextmenu="return false">
<?php 
	include('user/config.php');
	$cat = mysqli_query($mysqli,"SELECT * FROM Categories");
?>
<div id="wrapper-bg">
	<div id="wrapper">
		<div id="header" class="container">
			<div id="logo">
				<h1><a href="index.php"><span>News</span>Portal</a></h1>
			</div>
			<div id="menu">
				<ul>
					<li><a href="index.php" title="Account">Home</a></li>
					<li class="dropdown"><a> Categories</a>
						<div class="dropdown-content">
						<?php
							while($row=mysqli_fetch_assoc($cat)) 
							{	?>
							<a href="categories.php?id=<?php echo $row['ID'];?>" title="<?php echo $row['Categories_Type'];?>"><?php echo $row['Categories_Type'];?></a>
							<?php }?>
						</div>
					</li>
					<li class="active"><a href="account.php" title="Account">Account</a></li>
				</ul>
			</div>
		</div>
	<div>
	</div>
	</div>
	</div>
</body>
</html>