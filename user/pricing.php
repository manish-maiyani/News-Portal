<html>
<head>
<link rel="icon" type="image/gif/jpg" href="../images/logo-main.jpg">

<?php
session_start();
if ($_SESSION['user_name'] != '')
{
	include('../header/h-pricing.php'); 
?>

<title>News Portal - Pricing</title>
<link rel="stylesheet" type="text/css" href="../css/astyle.css" />


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

	<br>
	
<div class="container">
	<div class="whole">
		<div class="type">
			<p>1 Month</p>
		</div>
		<div class="plan">
			<div class="header">
				<span>Rs.</span>120</sup>
				<p class="month"></p>
			</div>
			<div class="content">
				<!-- <ul>
					<li></li>
					<li></li>
					<li></li>
					<li></li>
				</ul> -->
			</div>
			<div class="price">
      			<a href="../payment/PayUMoney_form.php?pack=1"><button type="submit" name="submit" class="bottom"><p class="cart">Pay Now</p></button></a>
			</div>
		</div>
	</div>
	<div class="whole">
		<div class="type">
			<p>3 Month</p>
		</div>
		<div class="plan">
			<div class="header">
				<span>Rs.</span>350</sup>
				<p class="month"></p>
			</div>
			<div class="content">
				<!-- <ul>
					<li>15 Email Accounts</li>
					<li>100GB Space</li>
					<li>1 Domain Name</li>
					<li>500GB Bandwidth</li>
				</ul> -->
			</div>
			<div class="price">
      			<a href="../payment/PayUMoney_form.php?pack=2"><button type="submit" name="submit" class="bottom"><p class="cart">Pay Now</p></button></a>
			</div>
		</div>
	</div>
	<div class="whole">
		<div class="type">
			<p>6 Month</p>
		</div>
		<div class="plan">
			<div class="header">
				<span>Rs.</span>700</sup>
				<p class="month"></p>
			</div>
			<div class="content">
				<!-- <ul>
					<li>15 Email Accounts</li>
					<li>100GB Space</li>
					<li>1 Domain Name</li>
					<li>500GB Bandwidth</li>
				</ul> -->
			</div>
			<div class="price">
      			<a href="../payment/PayUMoney_form.php?pack=3"><button type="submit" name="submit" class="bottom"><p class="cart">Pay Now</p></button></a>
			</div>
		</div>
	</div>
	<div class="whole">
		<div class="type">
			<p>1 Year</p>
		</div>
		<div class="plan">
			<div class="header">
				<span>Rs.</span>1000</sup>
				<p class="month"></p>
			</div>
			<div class="content">
				<!-- <ul>
					<li>15 Email Accounts</li>
					<li>100GB Space</li>
					<li>1 Domain Name</li>
					<li>500GB Bandwidth</li>
				</ul> -->
			</div>
			<div class="price">
      			<a href="../payment/PayUMoney_form.php?pack=4"><button type="submit" name="submit" class="bottom"><p class="cart">Pay Now</p></button></a>
			</div>
		</div>
	</div>	
</div>

<div style="clear: both;"> </div>
	<br><br><br><br><br>
	
	<?php include('../header/footer.php'); ?>
	
	<?php }
else
	echo "<br><br><br><br><br><br><br><br><br><br><br><br><center><font color = 'red'><h1>You cannot access this page without login.</h1></font></center>";
?>

	<style type="text/css">
	
	.price:hover a>button>p
	{
		color:#bfa30c;
	}	

	.price>a{
		font-size: 18px;
		font-family:'Open Sans';
	    color: white;
	    text-decoration: none;

	}

	input:focus,textarea:focus,select:focus{
	  border:1px solid #fafafa;
	  -webkit-box-shadow:0 0 6px #007eff;
	  -moz-box-shadow:0 0 5px #007eff;
	  box-shadow:0 0 5px #007eff;
	  outline: none;
	}

	sup{

		font-size: 40px;
	}

	.content>ul{
		list-style: none;
		font-size: 15px;
		font-family:'Open Sans';
		color: #9095aa;
		padding: 0px;
		margin: 0px;


	}


	.content>ul>li{
	border-bottom: 1px solid #494a5a;
	padding: 0px;
	margin: 0px;
	text-align: center;
	height: 52px;
	line-height: 52px;
	}


	.whole{
		float: left;
	  	width: calc(25% - 20px);
	  	padding: 10px;
	}



	.type{
		width: 100%;
		border-radius: 5px 5px 0px 0px;
		background-color: #99CCBB;;
		height: 62px;
		border-bottom: 3px solid #bfa30c;

	}

	.type p{
		font-family:'Open Sans';
	    font-weight: 800;
		font-size: 29px;
		text-transform: uppercase;
		color: white;
		text-align: center;
		padding-top: 10px;

		

	}

	.plan{
		width: 100%;
		background-color: #2b2937;

		border-radius: 0px 0px 5px 5px;
	    font-family:'Open Sans';
	    font-style:condensed;
	    font-size: 90px;
	    color: white;
	    text-align: center;


	}
	.standard{
		background-color: #1abc9c;
		border-bottom: 3px solid #18937b;
	}	

	.ultimate{
		background-color: #5d6a9a;
		border-bottom: 3px solid #474f6f;
	}





	.header{
		border-bottom: 1px solid #494a5a;
		padding-bottom: 39px;


	}

	.header span{
		font-size: 32px;

		
	}

	.month{
		font-size: 14px;
		color: #575757;
		padding: 0px;
		margin: -10px;
	}

	.price{
		height:80px;
	}

	.cart{
	  
	  color:white;
	  position: relative;
	  top: 16px;
	  
	}

	.bottom{
	  
	  background: none;
	  border: none;
	  outline: none;
	  font-size: 18px;
	}

	.content{
	}

	.login_c{
	  width:500px;
	  background-color:#2b2937;
	  height:300px;
	  margin: 0 auto;
	  margin-top:40px;
	  border-radius:5px;
	  
	}

	.login_c input{
	  width: 350px;
	height: 40px;
	  border: 1px solid #494a5a;
	  margin-bottom:20px;
	  border-radius:5px;
	  padding-left: 10px;

	}


	.login{
	  background-color: #BC4B1A;
		border-bottom: 3px solid #7C3618;
	  width:100%;
	  
	}

	.top{
	  margin-top:35px;
	}

	.nodisplay{
	  opacity: 0.1;
	}

	.selected{
	  background-color:#1F1B36;
	  margin:0px;
	  padding:0px;
	}

	</style>


</body>
</html>

