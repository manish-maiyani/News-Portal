<?php
ob_start();
session_start();
$mysqli = mysqli_connect("localhost", "root", "", "project1"); 	
if(!isset($_SESSION['admin_id']))
{
	header("location:index.php");
}
$admin_id = $_SESSION['admin_id'];
$qry = "select * from admin where ID=".$admin_id;
$res = mysqli_query($mysqli,$qry);
$row = mysqli_fetch_assoc($res);
$name = $row['Username'];
?>

<html>

<head>

<link href="../css/font.css" rel="stylesheet" type="text/css">
<link href="../css/default.css" rel="stylesheet" type="text/css" media="all" />
<link href="../css/drop.css" type="text/css" rel="stylesheet">

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
					<li><a href="home.php" title="User Details">User Details</a></li>
					<li class="dropdown"><a> Categories</a>
						<div class="dropdown-content">
							<a href="viewcategories.php" title="View Categories">View Categories</a>
							<a href="addcategories.php" title="Add Categories">Add Categories</a>
						</div>
					</li>
					<li class="dropdown"><a> News</a>
						<div class="dropdown-content">
							<a href="viewreqnews.php" title="View Requested News">View Requested News</a>
							<a href="viewupnews.php" title="View Uploaded News">View Uploaded News</a>
							<a href="viewdelnews.php" title="View Deleted News">View Deleted News</a>
							<a href="addnews.php" title="Add News">Add News</a>
						</div>
					</li>					
					<li class=""><a href="payment_details.php">Payment Details</a></li>					
					<li class=""><a href="view_feedback.php" title="View Feedback">View Feedback</a></li>

					<li class="dropdown"><a><?php echo $name; ?></a>
						<div class="dropdown-content">
							<a href="check_payments.php" title="">Refresh</a>
							<a href="logout.php" onclick="return confirm('Are you sure, you want to logout?')" title="">Logout</a>
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