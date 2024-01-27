<html>
<head>

<title>News Portal - View Advertisement Details</title>
<link rel="icon" type="image/gif/jpg" href="../images/logo-main.jpg">
<link rel="stylesheet" type="text/css" href="../css/ahstyle.css" />
<link href="../css/main.css" type="text/css" rel="stylesheet">

<style>
/* Paste this css to your style sheet file or under head tag */
/* This only works with JavaScript, 
if it's not present, don't show loader */
.no-js #loader { display: none;  }
.js #loader { display: block; position: absolute; left: 100px; top: 0; }
.se-pre-con {
	position: fixed;
	left: 0px;
	top: 0px;
	width: 100%;
	height: 100%;
	z-index: 9999;
	background: url(../images/Preloader_2.gif) center no-repeat #fff;
}
</style>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>
<script>
	//paste this code under head tag or in a seperate js file.
	// Wait for window load
	$(window).load(function() {
		// Animate loader off screen
		$(".se-pre-con").fadeOut("slow");;
	});
</script>

<?php
session_start();


if ($_SESSION['user_name'] != '')
{
	include('../header/h-advertise_details.php'); 

if(@$_GET['action']=='delete')
{
	$id = $_GET['id'];

	$sql = "select * from advertise where Advertise_ID=$id";
	$row = mysqli_fetch_assoc(mysqli_query($mysqli,$sql));

	unlink('advertise/'.$row['Advertise_Image']);
	$qry = "delete  from advertise where Advertise_ID=$id";
	$res = mysqli_query($mysqli,$qry);
	header('location:advertise_details.php');
}


	$adv = mysqli_query($mysqli,"SELECT * from advertise ORDER BY Advertise_ID DESC");


?>

<style>
table, th, td {
    border: 1px solid #8EBEAE;
}
</style>
</head>

<body>
   
<div class="se-pre-con"></div>
   
<div class="container">                 
	<div id="wrapper1">
        <h1>View Advertisement Details</h1>   
	</div>    
    	
	<br><br><br><br><br><br><br>
	<table width="100%" cellpadding="7">
		<tr>
			<th><font color="#8EBEAE"><h4><b><br>NO.</b></h4></font></th>
			<th><font color="#8EBEAE"><h4><b><br>ADVRTISE TITLE</b></h4></font></th>
			<th><font color="#8EBEAE"><h4><b><br>ADVERTISE IMAGE</b></h4></font></th>
			<th><font color="#8EBEAE"><h4><b><br>ACTION</b></h4></font></th>
		 
		<?php 
            $i=1;
            while($row = mysqli_fetch_assoc($adv)) 
            {		
        ?>
        
		<tr align="center">
            <td><?php  echo   $i; ?></td>	
            <td><?php  echo  $row['Advertise_Title'];?></td>
             <td><a href="advertise/<?php  echo  $row['Advertise_Image'];?>"><img src = "advertise/<?php  echo  $row['Advertise_Image'];?>" width="175" height="150"></a></td>	

            <td><a href="add_advertise.php?id=<?php echo $row['Advertise_ID']; ?>&action=update"><font color="red">UPDATE</font></a> || <a href="advertise_details.php?id=<?php echo $row['Advertise_ID']; ?>&action=delete" onclick="return confirm('Are you sure, you want to delete it?')"><font color="red">DELETE</font></a></td>
        </tr>
       
	   <?php $i++; }?>
	   
	</table>
	</div>
<br><br><br><br>
<?php include('../header/footer.php'); ?>
	
	<?php }
else
	echo "<br><br><br><br><br><br><br><br><br><br><br><br><center><font color = 'red'><h1>You cannot access this page without login.</h1></font></center>";
?>
</body>
</html>
