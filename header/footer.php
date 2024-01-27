<html>
<head>


</head>

<body>
<div id="wrapper-bg">
<div id="footer-content" class="container">
	
		<div id="fbox1">
			<h2>Recent Updates</h2>
			<marquee direction="up" onmouseover="this.stop()" onmouseout="this.start()" class="mar"> 
			<ul class="style3">
			<?php
				include('config.php');
				$cat = mysqli_query($mysqli,"SELECT * FROM news WHERE Status = 'Active' ORDER BY DT DESC limit 0,6");
		    	while($news= mysqli_fetch_assoc($cat))
		    	{
		    		$yrdata= strtotime($news['DT']);
	    			$m = date('M', $yrdata);
	    			$d = date('d', $yrdata);
    			?>

			
				<li>
					<p class="date"><a href="#"><?php echo $m; ?><b><?php echo $d; ?></b></a></p>
					<h3><a href="<?php if(strpos($news['Email'], '@') == false) echo $news['URL']; else echo "../user/news_details.php?id=".$news['ID']."&cat=".$news['Cat_ID'];?>">
						<div color="black" style="    display: -webkit-box;height: 66px;-webkit-line-clamp: 3;-webkit-box-orient: vertical;overflow: hidden;text-overflow: ellipsis;"><?php echo $news['Title']; ?></div>
					</a></h3>
				</li>
			
			<?php } ?>
			</ul>
			</marquee>
		</div>

		<div id="fbox2">
			<h2>Map</h2>
			<div class="gmap_canvas">
				<iframe id="gmap_canvas" src="https://maps.google.com/maps?width=100%&amp;height=600&amp;hl=en&amp;q=Deep%20Kamal%20Shopping%20Cente+(My%20Business%20Name)&amp;ie=UTF8&amp;t=&amp;z=18&amp;iwloc=B&amp;output=embed" width="430" height="220" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
			</div>
			<style>.gmap_canvas {overflow:hidden;background:none!important;}</style>
		</div>

		<div id="fbox3">
			<h2>Contact</h2>
			<p>For any enquiry or any type of suggetions or complains, please contact us.</p>
			<ul class="style5">
				<li class="first"><span class="address">Address</span> <span class="address-01">G/455 Deep Kamal Shopping Center <br />
					Surat, Gujarat 395010</span> </li>
				<li> <span class="mail">Mail</span> <span class="mail-01"><a href="https://plus.google.com/u/0/114660791064435528323" target="_blank">newsportal@news.com</a></span> </li>
				<li> <span class="phone">Phone</span> <span class="phone-01">(+126) 652-4962</span> </li>
			</ul>
		</div>

</div>
</div>
<div id="footer">
	<br>
	<p>&copy; All rights reserved. Design by <a href="https://www.instagram.com/immmaiyani18/" target="_blank"><b>ImMMaiyani</b></a>. </p>
</div>

</body>
</html>