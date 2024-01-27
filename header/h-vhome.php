<html>

<head>

<link href="../css/font.css" rel="stylesheet" type="text/css">
<link href="../css/default.css" rel="stylesheet" type="text/css" media="all" />
<link href="../css/drop.css" type="text/css" rel="stylesheet">
<link href="../css/profile.css" rel="stylesheet" type="text/css">

</head>

<body oncontextmenu="return false">

<div id="wrapper-bg">
	<div id="wrapper">
		<div id="header" class="container">
			<div id="logo">
				<h1><a href="home.php"><span>News</span>Portal</a></h1>
			</div>
			
			<div id="menu">
				<ul>
					<li class="active"><a href="home.php" title="Verify Mobile Number">Verify Mobile Number</a></li>
					
					<li class="dropdown chip"><a href="#"> <img src="<?php echo "../".$_SESSION['i_path']; ?>" ><?php echo $_SESSION['user_name']; ?></a>
						<div class="dropdown-content">
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