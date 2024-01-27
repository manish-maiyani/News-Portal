<html>
<head>
<link rel="icon" type="image/gif/jpg" href="../images/logo-main.jpg">

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
if ($_SESSION['user_name'] == '')
	echo "<br><br><br><br><br><br><br><br><br><br><br><br><center><font color = 'red'><h1>You cannot access this page without login.</h1></font></center>";

else
{
	include('config.php');
?>

<title>News Portal - Home</title>
<link href="../css/sli.css" type="text/css" rel="stylesheet">
<link href="../css/pagination.css" type="text/css" rel="stylesheet">
<link href="../css/main.css" type="text/css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../css/mobbutn.css" />
<link rel="stylesheet" type="text/css" href="../css/all.main.css" />

<script type="text/javascript" src="../js/all.min.js"></script> 


</head>

<body>

	<div class="se-pre-con"></div>

	<?php
		if($_SESSION['mob'] == 0)
	{ include('../header/h-vhome.php'); 
	?>
	<br>
		<div id="page">
			<div id="content" class="container1">
				<section>				
               
                    <div id="wrapper1">
                        <div id="login">
                            <form action=""  method="POST"> 
                                <h1>Verify Mobile Number</h1> 
								
                                <?php
                                	
                                	if(isset($_POST['otp']))
                                	{
                                		$_SESSION['m']=$_POST['mob'];
	                                	$query = mysqli_query($mysqli,"SELECT * FROM registration WHERE Mobile_No='".$_SESSION['m']."'");
	                                	if(mysqli_num_rows($query)==0)
										{
	                                		$h=mt_rand(100000,999999);
	        								$_SESSION["otp_very"]=$h;
	        								
	     									
	     										$mobile = "91".$_POST['mob'];
										        $message = rawurlencode("Hello, ".$_SESSION['user_name']."! \nYour One Time Password(OTP) is ".$h."");
										        $key1 = "Vgu6qMxiv0O96Ssn49k6fg";
										        
										        $url = 'http://login.smsgatewayhub.com/api/mt/SendSMS?APIKey=' . $key1 . '&senderid=TESTIN&channel=2&DCS=0&flashsms=0&number=' . $mobile . '&text=' . $message . '&route=1;';
										        
										        $ch = curl_init($url);
										        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
										        curl_setopt($ch, CURLOPT_POST, 1);
										        curl_setopt($ch, CURLOPT_POSTFIELDS, "");
										        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 2);
										        $data = curl_exec($ch);

										        if($data != null)
										      	{
													echo "<center><h3><font color='red'>";
													echo "OTP is successfully sent to +".$mobile."!";
													echo "</font></h3></center><br>";
									        	}
	     										
								    	}
								    	else
								    		echo "<center><h3><font color='red'>Mobile Number is already used!</font></h3></center><br>";
								    }

                                	if(isset($_POST['verify']))
                                	{
                                		$ver = $_POST['eotp'];
                                		
                                		if($_SESSION["otp_very"] == $ver)
                                		{
                                			mysqli_query($mysqli,"UPDATE registration SET Mobile_No='".$_SESSION['m']."' WHERE ID='".$_SESSION['user_id']."'");
                                			$query = mysqli_query($mysqli,"SELECT * FROM registration WHERE ID='".$_SESSION['user_id']."'");

											if(mysqli_num_rows($query)==1)
											{
												while ($row = mysqli_fetch_assoc($query))
												{							
													$_SESSION['mob'] = $row['Mobile_No'];
												}
	                                			echo "<script type='text/javascript'> document.location.href='home.php'; alert('You have successfully verified your Mobile Number!'); </script>";
	                                		}
	                                	}
	                                	else
	                                		echo "<center><h3><font color='red'>Incorrect OTP!</font></h3></center>";
                               	    }
                                ?>

								<p> 
                                    <label data-icon="m"> Enter Mobile Number </label><br>
                                    <input name="mob" minlength="10" maxlength="10" type="text" placeholder="0123456789" <?php if(isset($_POST['otp']) || isset($_POST['eotp'])){?>value="<?php echo $_POST['mob']; ?>" <?php } else{?> required <?php } ?>/>
                                </p>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <p class="login button">
								<input type="submit" name="otp" value="Send OTP"/> 
								</p>
								<br><br>
                                <p> 
                                    <label data-icon="o"> Enter OTP </label><br>
                                    <input name="eotp" type="text" placeholder="0123456" <?php if(isset($_POST['otp']) && isset($_POST['eotp'])){?> required <?php } ?>/>
                                </p>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <p class="login button">
                                <input type="submit" name="verify" value="Verify OTP"/> 
                            	</p>
								<br><br>
                            </form>
                        </div>
                    </div>
               
            </section>
			</div>
		</div>
		<br><br><br><br><br><br><br>

		<div id="footer">
	<p>&copy; All rights reserved. Design by <a href=""><b>ImMMaiyani</b></a> and <a href=""><b>Disha_Vora</b></a>.</p>
</div>

	<?php
	}  
	
	else
	{
		include('../header/h-home.php'); 
	?>
	<br>
	<div class="container"> 
		
		<div class="fling-minislide">
		<?php

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

	   		$cat = mysqli_query($mysqli,"SELECT * FROM news WHERE Status = 'Active' ORDER BY DT DESC limit 0,6");
	   		
	    	while($news= mysqli_fetch_assoc($cat))
	    	{
	     	?>
				<img src="<?php echo $news['Image_Path'];?>" /><?php } ?>
			</div>
	 	
	    <br><br><br><br>
	    <?php
	    	$i=0;

	    	if($_SERVER['REQUEST_URI'] == '/News%20Portal/user/home.php' )
			{
				$page1 = 0;
				$page = 1;
			}
			else
			{
				$page = $_GET['page'];
				$page1 = ($page*6)-6;
			}
	    	$cat = mysqli_query($mysqli,"SELECT * FROM news WHERE Status = 'Active' ORDER BY DT DESC limit $page1,6");
	    	while($news= mysqli_fetch_assoc($cat))
	    	{
	     ?>
		<section id="one" class="wrapper style1">
				<div class="inner">
					<article class="feature <?php if($i%2==0) echo "left"; else echo "right" ?>">
						<span class="image">
							<a href="<?php echo $news['Image_Path']; ?>"><img src="<?php echo $news['Image_Path']; ?>" alt="" height="257" width="330"/></a>
						</span>
						<div class="content">
							<h2>
								<a href="counter.php?href=<?php if(strpos($news['Email'], '@') == false) echo $news['URL']."&id=".$news['ID']; else echo "news_details.php&id=".$news['ID']; ?>"; title="<?php echo $news['Title'];?>" >

								<div color="#373534" style="white-space: nowrap; overflow: hidden;text-overflow: ellipsis;"><?php echo $news['Title']; ?></div>
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
									<a href="counter.php?href=<?php if(strpos($news['Email'], '@') == false) echo $news['URL']."&id=".$news['ID']; else echo "news_details.php&id=".$news['ID']."&cat=".$news['Cat_ID'];?>" class="button alt" style="float: left;">More</a>
									

									<span class="counter" style="float: right;">

<a href="download.php?href=<?php if(strpos($news['Email'], '@') == false) echo $news['URL']."&title=".$news['Title']; else echo "news_details.php&id=".$news['ID'];?>" style="color:black;">
	<i class="fa fa-download" style=" font-size:15px; margin-top: 20px; margin-right: 5px; float:left;"></i></a>
									<p class="number" style="float: right; margin-top: 15px;">&nbsp;<?php echo $news['count']; ?></p>
									<i class="far fa-eye" style=" font-size:15px; margin-top: 20px; float:right;"></i>

									</span>

								</li>
							</ul><br>
						</div>
					</article>
				</div>
			</section>
			</div>	
		<?php $i++; } 
	$cat = mysqli_query($mysqli,"SELECT * FROM news WHERE Status = 'Active'");	
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
			<a href = "home.php?page=1"> << </a>
		<?php }

     	if($page<=3)
     	{
     		if($a>=5)
     			$s = 5;
     		else
     			$s = $a;
     		for($b=1 ; $b <= $s ; $b++)
			{?>	
				<a href = "home.php?page=<?php echo $b; ?>" <?php if($page == $b) { echo ' class="active"'; } ?> > <?php echo $b." "; ?> </a>
			<?php }
		}
		
		elseif (in_array($page, $lar) && $page<=$a) 
		{
			$pp=$a;

			if($page == $a && $a>=5)
			{
			 	for($b=$pp-4 ; $b <= $a ; $b++)
				{?>	
					<a href = "home.php?page=<?php echo $b; ?>" <?php if($page == $b) { echo ' class="active"'; } ?> > <?php echo $b." "; ?> </a>
				<?php }
			}
			else
			{
				if($a<5)
				{
					$pp++;
					for($b=$pp-4 ; $b <= $a ; $b++)
					{?>	
						<a href = "home.php?page=<?php echo $b; ?>" <?php if($page == $b) { echo ' class="active"'; } ?> > <?php echo $b." "; ?> </a>
					<?php }
				}
				else
				{
					for($b=$pp-4 ; $b <= $a ; $b++)
					{?>	
						<a href = "home.php?page=<?php echo $b; ?>" <?php if($page == $b) { echo ' class="active"'; } ?> > <?php echo $b." "; ?> </a>
					<?php }
				}
			}
		} 
		else
		{ 
			for($b=max(1, $page - 2) ; $b <= min($page + 2, $a) ; $b++)
			{?>	
				<a href = "home.php?page=<?php echo $b; ?>" <?php if($page == $b) { echo ' class="active"'; } ?> > <?php echo $b." ";?>  </a>
			<?php } 
			
		}

		if(!in_array($page, $lar) && $a>5) 
			{?>
				<a href = "home.php?page=<?php echo $a; ?>"> >> </a>
		<?php }
	?>		
  	
	</div></div>
	</center>

	<br><br><br><br>
	<?php include('../header/footer.php'); 
	} }
	 ?> 

</body>
</html>
