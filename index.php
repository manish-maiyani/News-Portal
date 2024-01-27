<html>

<head>

<title>News Portal - Home</title>
<link rel="icon" type="image/gif/jpg" href="images/logo-main.jpg" />
<link href="css/sli.css" type="text/css" rel="stylesheet">
<link href="css/pagination.css" type="text/css" rel="stylesheet">
<link href="css/main.css" type="text/css" rel="stylesheet">


<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="js/all.min.js"></script> 


<style>
.no-js #loader { display: block; position: absolute; left: 100px; top: 0; }
.js #loader { display: block; position: absolute; left: 100px; top: 0; }
.se-pre-con {
	position: fixed;
	left: 0px;
	top: 0px;
	width: 100%;
	height: 100%;
	z-index: 9999;
	background: url(images/Preloader_2.gif) center no-repeat #fff;
}
</style>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>
<script>
	$(window).load(function() {
		$(".se-pre-con").fadeOut("slow");;
	});
</script>

</head>

<body>

<div class="se-pre-con"></div>

	<?php 
		include('header/h-index.php');
		include('user/config.php');
		//old apikey=e12dcd7ad7084d6ea57296ba0f9a1261
		$business = file_get_contents("https://newsapi.org/v2/top-headlines?category=business&apiKey=e51c0854f7674ca3a2ed71251667f054&language=en");
		$js = json_decode($business,true);

		$i = 0;
		foreach ($js['articles'] as $value) 
		{             
			if($js['articles'][$i]['author']!='' && addslashes($js['articles'][$i]['title'])!='' && addslashes($js['articles'][$i]['content'])!='' && $js['articles'][$i]['urlToImage']!='' && $js['articles'][$i]['publishedAt']!='' && $js['articles'][$i]['url']!='')
			{
				$check = mysqli_query($mysqli,"SELECT * FROM news WHERE Title = '".addslashes($js['articles'][$i]['title'])."'");

				if(mysqli_num_rows($check) == 0)
				{
					$a = mysqli_query($mysqli,"SELECT * FROM categories WHERE Categories_Type = 'Bussiness News'");
					$res = mysqli_fetch_assoc($a);
					$c =$res['ID'];
					mysqli_query($mysqli,"INSERT INTO news (Email,Cat_ID,Title,Status,Description,Image_Path,DT,URL)
													VALUES ('".$js['articles'][$i]['author']."',$c,'".addslashes($js['articles'][$i]['title'])."','Active','".addslashes($js['articles'][$i]['content'])."','".$js['articles'][$i]['urlToImage']."','".$js['articles'][$i]['publishedAt']."','".$js['articles'][$i]['url']."')");
					$i++;
				}
			}
		}

		$entertainment = file_get_contents("https://newsapi.org/v2/top-headlines?category=entertainment&apiKey=e51c0854f7674ca3a2ed71251667f054&language=en");
		$js = json_decode($entertainment,true);

		$i = 0;
		foreach ($js['articles'] as $value) 
		{             
			if($js['articles'][$i]['author']!='' && addslashes($js['articles'][$i]['title'])!='' && addslashes($js['articles'][$i]['content'])!='' && $js['articles'][$i]['urlToImage']!='' && $js['articles'][$i]['publishedAt']!='' && $js['articles'][$i]['url']!='')
			{
				$check = mysqli_query($mysqli,"SELECT * FROM news WHERE Title = '".addslashes($js['articles'][$i]['title'])."'");
				if(mysqli_num_rows($check) == 0)
				{
					$a = mysqli_query($mysqli,"SELECT * FROM categories WHERE Categories_Type = 'Entertainment News'");
					$res = mysqli_fetch_assoc($a);
					$c =$res['ID'];
					mysqli_query($mysqli,"INSERT INTO news (Email,Cat_ID,Title,Status,Description,Image_Path,DT,URL)
													VALUES ('".$js['articles'][$i]['author']."',$c,'".addslashes($js['articles'][$i]['title'])."','Active','".addslashes($js['articles'][$i]['content'])."','".$js['articles'][$i]['urlToImage']."','".$js['articles'][$i]['publishedAt']."','".$js['articles'][$i]['url']."')");
					$i++;
				}
			}
		}

		$sport = file_get_contents("https://newsapi.org/v2/top-headlines?category=sports&apiKey=e51c0854f7674ca3a2ed71251667f054&language=en");
		$js = json_decode($sport,true);

		$i = 0;
		foreach ($js['articles'] as $value) 
		{             
			if($js['articles'][$i]['author']!='' && addslashes($js['articles'][$i]['title'])!='' && addslashes($js['articles'][$i]['content'])!='' && $js['articles'][$i]['urlToImage']!='' && $js['articles'][$i]['publishedAt']!='' && $js['articles'][$i]['url']!='')
			{
				$check = mysqli_query($mysqli,"SELECT * FROM news WHERE Title = '".addslashes($js['articles'][$i]['title'])."'");
				if(mysqli_num_rows($check) == 0)
				{
					$a = mysqli_query($mysqli,"SELECT * FROM categories WHERE Categories_Type = 'Sport News'");
					$res = mysqli_fetch_assoc($a);
					$c =$res['ID'];
					mysqli_query($mysqli,"INSERT INTO news (Email,Cat_ID,Title,Status,Description,Image_Path,DT,URL)
													VALUES ('".$js['articles'][$i]['author']."',$c,'".addslashes($js['articles'][$i]['title'])."','Active','".addslashes($js['articles'][$i]['content'])."','".$js['articles'][$i]['urlToImage']."','".$js['articles'][$i]['publishedAt']."','".$js['articles'][$i]['url']."')");
					$i++;
				}
			}
		}

		$tech = file_get_contents("https://newsapi.org/v2/top-headlines?category=technology&apiKey=e51c0854f7674ca3a2ed71251667f054&language=en");
		$js = json_decode($tech,true);

		$i = 0;
		foreach ($js['articles'] as $value) 
		{             
			if($js['articles'][$i]['author']!='' && addslashes($js['articles'][$i]['title'])!='' && addslashes($js['articles'][$i]['content'])!='' && $js['articles'][$i]['urlToImage']!='' && $js['articles'][$i]['publishedAt']!='' && $js['articles'][$i]['url']!='')
			{
				$check = mysqli_query($mysqli,"SELECT * FROM news WHERE Title = '".addslashes($js['articles'][$i]['title'])."'");
				if(mysqli_num_rows($check) == 0)
				{
					$a = mysqli_query($mysqli,"SELECT * FROM categories WHERE Categories_Type = 'Tech News'");
					$res = mysqli_fetch_assoc($a);
					$c =$res['ID'];
					mysqli_query($mysqli,"INSERT INTO news (Email,Cat_ID,Title,Status,Description,Image_Path,DT,URL)
													VALUES ('".$js['articles'][$i]['author']."',$c,'".addslashes($js['articles'][$i]['title'])."','Active','".addslashes($js['articles'][$i]['content'])."','".$js['articles'][$i]['urlToImage']."','".$js['articles'][$i]['publishedAt']."','".$js['articles'][$i]['url']."')");
					$i++;
				}
			}
		}
	?>
	<br>
	<style type="text/css">
		.advertise
		{
			height: 90px;width: 700px;background: lightgray;margin: 0px auto 32px;
			position: relative;
		}
		.hvr_add
		{
			position: absolute;
			top: 0;
			left: 0;
			height: 100%;
			width: 100%;
			background: rgba(0,0,0,.8);
			text-align: center;
			color: #fff;
			opacity: 0;
			transition: .3s;
			cursor: pointer;
		}
		.hvr_add span
		{
			position: absolute;
			top: 50%;
			left: 0;
			transform: translateY(-50%);
			width: 100%; 
			font-size: 20px;
		}
		.advertise:hover .hvr_add
		{
			opacity: 1;
		}

	</style>
	<div class="container"> 
		
		<div class="fling-minislide">

		<?php

	   		$cat = mysqli_query($mysqli,"SELECT * FROM news WHERE Status = 'Active' and Email NOT LIKE '%@%' ORDER BY DT DESC limit 0,6");
	   		
	    	while($news= mysqli_fetch_assoc($cat))
	    	{
	     	?>
				<img src="<?php echo $news['Image_Path'];?>" /><?php } ?>
			</div>
	 	
	    <br><br>

				<div class="advertise" >
	     		<?php
	     		$adv_user_sql = "select UDF1 from payment";
	     		$res_adv_user = mysqli_query($mysqli,$adv_user_sql);
	     		$users = array();
	     		while($user_arr = mysqli_fetch_assoc($res_adv_user)){
	     			$users[]  = $user_arr['UDF1'];
	     		}
	     		if(!empty($users)){

	     		$str = implode(",", $users);
	     	 	$adv = mysqli_query($mysqli,"SELECT * FROM `advertise` where ID in ($str) order by RAND() limit 1");

	     	 	$row= mysqli_fetch_assoc($adv);
	     	 	
	     		?>
	     		<img src="user/advertise/<?php echo $row['Advertise_Image']; ?>" width="100%" height="100%"> 
	     		<div class="hvr_add">
					<span><?php echo $row['Advertise_Title'];?></span>
				</div>
	     		<?php 
	     		} ?> 
	     		</div>


	    <?php
	    	$i=0;

	    	if($_SERVER['REQUEST_URI'] == '/News%20Portal/index.php' || $_SERVER['REQUEST_URI'] == '/News%20Portal/')
			{
				$page1 = 0;
				$page = 1;
			}
			else
			{
				$page = $_GET['page'];
				$page1 = ($page*6)-6;
			}
	    	$cat = mysqli_query($mysqli,"SELECT * FROM news WHERE Status = 'Active' and Email NOT LIKE '%@%' ORDER BY DT DESC limit $page1,6");
	    	
	    	while($news= mysqli_fetch_assoc($cat))
	    	{
	     ?>

	      

		<section id="one" class="wrapper style1">
				<div class="inner">
					<article class="feature <?php if($i%2==0) echo "left"; else echo "right" ?>">
						<span class="image">
							<a href="<?php echo $news['Image_Path']; ?>"><img src="<?php echo $news['Image_Path']; ?>" alt="" height="250" width="330"/>	<!-- <i class="fab fa-facebook-square" style="color: white; font-size:20px; margin: 5px 20px 5px 5px; float: right;"></i> --></a>
						</span>
						<div class="content">
							<h2>
								<a href="<?php echo $news['URL']; ?>" title="<?php echo $news['Title'];?>">
									<div color="#373534" style="white-space: nowrap; overflow: hidden;text-overflow: ellipsis;"><?php echo $news['Title']; ?></div>
								</a>
							</h2>
							<h4 style = "text-align: right;"><font color="#A2A2A1">
							<?php 
								$dt = date("d-m-Y H:i:s",strtotime($news['DT']));
								echo "- ".$news['Email']." | ".$dt;
							?>
							</font></h4>
						
							<p class="blog_content"><?php echo $news['Description']; ?></p>
							<ul class="actions">
								<li>
									<a href="<?php echo $news['URL']; ?>" class="button alt">More</a>
								</li>
							</ul><br>
						</div>
					</article>
				</div>
			</section>
			</div>	
		<?php $i++; } 
	$cat = mysqli_query($mysqli,"SELECT * FROM news WHERE Status = 'Active' and Email NOT LIKE '%@%'");	
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
			<a href = "index.php?page=1"> << </a>
		<?php }

     	if($page<=3)
     	{
     		if($a>=5)
     			$s = 5;
     		else
     			$s = $a;
     		for($b=1 ; $b <= $s ; $b++)
			{?>	
				<a href = "index.php?page=<?php echo $b; ?>" <?php if($page == $b) { echo ' class="active"'; } ?> > <?php echo $b." "; ?> </a>
			<?php }
		}
		
		elseif (in_array($page, $lar) && $page<=$a) 
		{
			$pp=$a;

			if($page == $a && $a>=5)
			{
			 	for($b=$pp-4 ; $b <= $a ; $b++)
				{?>	
					<a href = "index.php?page=<?php echo $b; ?>" <?php if($page == $b) { echo ' class="active"'; } ?> > <?php echo $b." "; ?> </a>
				<?php }
			}
			else
			{
				if($a<5)
				{
					$pp++;
					for($b=$pp-4 ; $b <= $a ; $b++)
					{?>	
						<a href = "index.php?page=<?php echo $b; ?>" <?php if($page == $b) { echo ' class="active"'; } ?> > <?php echo $b." "; ?> </a>
					<?php }
				}
				else
				{
					for($b=$pp-4 ; $b <= $a ; $b++)
					{?>	
						<a href = "index.php?page=<?php echo $b; ?>" <?php if($page == $b) { echo ' class="active"'; } ?> > <?php echo $b." "; ?> </a>
					<?php }
				}
			}
		} 
		else
		{ 
			for($b=max(1, $page - 2) ; $b <= min($page + 2, $a) ; $b++)
			{?>	
				<a href = "index.php?page=<?php echo $b; ?>" <?php if($page == $b) { echo ' class="active"'; } ?> > <?php echo $b." ";?>  </a>
			<?php } 
			
		}

		if(!in_array($page, $lar) && $a>5) 
			{?>
				<a href = "index.php?page=<?php echo $a; ?>"> >> </a>
		<?php }
	?>	
	
	</div>
	</div>
	</center><br><br><br><br>

	<?php include('header/vfooter.php'); ?>

		
</body>
</html>
