<html>
<head>
<link rel="icon" type="image/gif/jpg" href="../images/logo-main.jpg">

<?php
session_start();
if ($_SESSION['user_name'] != '')
{
	include('../header/h-categories.php'); 
	$cid = $_GET['id'];
	$c = mysqli_query($mysqli,"SELECT * FROM Categories WHERE ID = '".$_GET['id']."'");
	while($row = mysqli_fetch_assoc($c))
	{
?>

<title>News Portal - <?php echo $row['Categories_Type']; ?></title>
<link rel="stylesheet" type="text/css" href="../css/all.main.css" />
<link href="../css/main.css" type="text/css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../css/ahstyle.css" />
<link href="../css/pagination.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="../js/all.min.js"></script> 

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

		<div class="container">
		<div id="wrapper1">
        <h1><?php echo $row['Categories_Type']; }?></h1>   
	</div>  
		<br><br><br><br><br><br><br>
	    <?php
	    	$i=0;

	    	if($_SERVER['REQUEST_URI'] == "/News%20Portal/user/categories.php?id=".$_GET['id']."")
			{
				$page1 = 0;
				$page = 1;
			}
			else
			{
				$page = $_GET['page'];
				$page1 = ($page*6)-6;
			}

	    	$cat = mysqli_query($mysqli,"SELECT * FROM news where Status = 'Active' and Cat_ID='".$_GET['id']."' ORDER BY DT DESC limit $page1,6");
	    	while($news= mysqli_fetch_assoc($cat))
	    	{	
	     ?>
		<section id="one" class="wrapper style1">
				<div class="inner">
					<article class="feature <?php if($i%2==0) echo "left"; else echo "right" ?>">
						<span class="image"><a href="<?php echo $news['Image_Path']; ?>"><img src="<?php echo $news['Image_Path']; ?>" alt="" height="250" width="330"/></a>
						</span>
						<div class="content">
							<h2>

								<a href="counter.php?href=<?php if(strpos($news['Email'], '@') == false) echo $news['URL']."&id=".$news['ID']; else echo "news_details.php&id=".$news['ID']; ?>"; title="<?php echo $news['Title'];?>" >

								<div color="#373534" style="white-space: nowrap; overflow: hidden;text-overflow: ellipsis;">
									<?php echo $news['Title']; ?>
								</div>
								</a>
							</h2>

							<h4 style = "text-align: right;"><font color="#A2A2A1">
							<?php 
								$c = mysqli_query($mysqli,"SELECT * FROM registration WHERE Email = '".$news['Email']."'");
								if(mysqli_num_rows($c) >0)
								{
									while($row = mysqli_fetch_assoc($c))
									{
										$dt = date("d-m-Y H:i:s",strtotime($news['DT']));
										echo "- ".$row['Username']." (".$news['Email'].") | ".$dt; 
									}
								}
								else
								{
									$dt = date("d-m-Y H:i:s",strtotime($news['DT']));
									echo "- ".$news['Email']." | ".$dt;
								}
							?>
							</font></h4>

							<p class="blog_content"><?php echo $news['Description']; ?></p>
							<ul class="actions">
								<li style="display: block;">
									<a href="counter.php?href=<?php if(strpos($news['Email'], '@') == false) echo $news['URL']."&id=".$news['ID']; else echo "news_details.php&id=".$news['ID']."&cat=".$news['Cat_ID'];?>" class="button alt">More</a>
									<span class="counter" style="float: right;">
										<a href="download.php?href=<?php if(strpos($news['Email'], '@') == false) echo $news['URL']."&title=".$news['Title']; else echo "news_details.php&id=".$news['ID'];?>" style="color:black;">
	<i class="fa fa-download" style=" font-size:15px; margin-top: 20px; margin-right: 5px; float:left;"></i></a>
									<p class="number" style="float: right; margin-top: 15px;"><?php echo $news['count']; ?></p>
									<i class="far fa-eye" style=" font-size:15px; margin-top: 20px; float:right;"></i>

									</span>
								</li>
							</ul><br>
						</div>
					</article>
				</div>
			</section>	
		<?php $i++; } ?>
	</div>
	
	<?php
		$cat = mysqli_query($mysqli,"SELECT * FROM news where Status = 'Active' and Cat_ID='".$_GET['id']."'");	
		$r = mysqli_num_rows($cat);
		$a = ceil($r/6);

		?>
		<center>
		<div class='pa'>
	    <div class='pagination'>
	    		
	  	<?php
    	$far = array(1,2,3);
    	$lar = array($a,$a-1,$a-2);
    	
    	if(!in_array($page, $far) && $a>5) 
		{ ?>
			<a href = "categories.php?id=<?php echo $cid; ?>&page=1"> << </a>
		<?php }

     	if($page<=3)
     	{
     		if($a>=5)
     			$s = 5;
     		else
     			$s = $a;
     		for($b=1 ; $b <= $s ; $b++)
			{?>	
				<a href = "categories.php?id=<?php echo $cid; ?>&page=<?php echo $b; ?>" <?php if($page == $b) { echo ' class="active"'; } ?> > <?php echo $b." "; ?> </a>
			<?php }
		}
		
		elseif (in_array($page, $lar) && $page<=$a) 
		{
			$pp=$a;

			if($page == $a && $a>=5)
			{
			 	for($b=$pp-4 ; $b <= $a ; $b++)
				{?>	
					<a href = "categories.php?id=<?php echo $cid; ?>&page=<?php echo $b; ?>" <?php if($page == $b) { echo ' class="active"'; } ?> > <?php echo $b." "; ?> </a>
				<?php }
			}
			else
			{
				if($a<5)
				{
					$pp++;
					for($b=$pp-4 ; $b <= $a ; $b++)
					{?>	
						<a href = "categories.php?id=<?php echo $cid; ?>&page=<?php echo $b; ?>" <?php if($page == $b) { echo ' class="active"'; } ?> > <?php echo $b." "; ?> </a>
					<?php }
				}
				else
				{
					for($b=$pp-4 ; $b <= $a ; $b++)
					{?>	
						<a href = "categories.php?id=<?php echo $cid; ?>&page=<?php echo $b; ?>" <?php if($page == $b) { echo ' class="active"'; } ?> > <?php echo $b." "; ?> </a>
					<?php }
				}
			}
		} 
		else
		{ 
			for($b=max(1, $page - 2) ; $b <= min($page + 2, $a) ; $b++)
			{?>	
				<a href = "categories.php?id=<?php echo $cid; ?>&page=<?php echo $b; ?>" <?php if($page == $b) { echo ' class="active"'; } ?> > <?php echo $b." ";?>  </a>
			<?php } 
			
		}

		if(!in_array($page, $lar) && $a>5) 
			{?>
				<a href = "categories.php?id=<?php echo $cid; ?>&page=<?php echo $a; ?>"> >> </a>
		<?php }
	?>		

	</div></div>
	</center>

	<br><br><br><br>
	<?php include('../header/footer.php'); ?>
	<?php } 
	else
		echo "<br><br><br><br><br><br><br><br><br><br><br><br><center><font color = 'red'><h1>You cannot access this page without login.</h1></font></center>";
	?>
</body>
</html>
