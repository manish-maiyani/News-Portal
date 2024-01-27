<html>
<head>
<link rel="icon" type="image/gif/jpg" href="../images/logo-main.jpg">

<?php
session_start();
if ($_SESSION['user_name'] != '')
{
	include('../header/h-categories.php'); 

	$cat = mysqli_query($mysqli,"SELECT news.*,categories.Categories_Type,registration.Username FROM news join categories on categories.ID=news.Cat_ID join registration on registration.Email=news.Email where news.ID=".$_GET['id']);
	$news = mysqli_fetch_assoc($cat);
?>
<title>News Portal - <?php echo $news['Categories_Type']; ?></title>
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

</head>

<body>

<div class="se-pre-con"></div>

	<div id="page">
		<div class="container"> 

			<h1><u><center><font color="#373534"><?php echo $news['Title']; ?></font></center></u></h1>
	
			<h4 style = "text-align: right;"><font color="#A2A2A1">
			<?php 
					$dt = date("d-m-Y H:i:s",strtotime($news['DT']));
					echo "<br>- <a href = 'categories.php?id=".$news['Cat_ID']."' title='".$news['Categories_Type']."' style='color: #A2A2A1'>".$news['Categories_Type']."</a><br>";
					echo "- ".$news['Username']." | ".$dt; 
			?>	
			</font></h4>

			<br><br><br>
			<a href="<?php echo $news['Image_Path']; ?>"><img src="<?php echo $news['Image_Path']; ?>" width="100%" height="90%"></a>

			<br><br><br><br><br>
			<h3><p><font color="#3B3939"><?php echo $news['Description']; ?></font></p></h3>
		</div>
	</div>
	<br><br>
	
	<?php include('../header/footer.php'); ?>
	<?php }
	else
		echo "<br><br><br><br><br><br><br><br><br><br><br><br><center><font color = 'red'><h1>You cannot access this page without login.</h1></font></center>";
	?>
</body>
</html>
