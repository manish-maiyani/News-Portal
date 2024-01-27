<html>
<head>
<link rel="icon" type="image/gif/jpg" href="../images/logo-main.jpg">

<?php
session_start();
if ($_SESSION['user_name'] != '')
{
	include('../header/h-feedback.php'); 
?>

<title>News Portal - Feedback</title>
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
		<div id="page">
			<div id="content" class="container1">
				<section>				
               
                    <div id="wrapper1">
                        <div id="login">
                            <form action=""  method="POST"> 
                                <h1>Feedback</h1> 
								
								<?php
									if(isset($_POST['send']))
									{
											mysqli_query($mysqli,"INSERT INTO feedback (Email, A_Goal, R_Visit, RCA_Goal, Suggestions, F_DT)
												VALUES ('".$_SESSION['mmail']."','".$_POST['goal']."','".$_POST['visit']."','".$_POST['notgoal']."','".addslashes($_POST['suggestions'])."',now())") or die(mysqli_error($mysqli));
											echo "<center><h3><font color='red'>Feedback submitted successfully!</font></h3></center>";
									}
								?>
								<br>
								
								<p> 
                                    <label data-icon="a"> Do you achieve your goal? </label><br>
                                    <input list="goal" name="goal" placeholder="eg. Yes/No" required>
										<datalist id="goal">
											<option value="Yes"></option>
											<option value="No"></option>
											<option value="Partially"></option>
											<option value="None"></option>
										</datalist>
                                </p>
								<p>
									<label data-icon="v"> What is the reason for your visit? </label><br>
									<input list="visit" name="visit" placeholder="eg. Amazing page" required>
										<datalist id="visit">
											<option value="Find lucrative"></option>
											<option value="Get appropriate information"></option>
											<option value="Very easy to use"></option>
											<option value="Other"></option>
											<option value="None"></option>
										</datalist>
								</p>
								<p>
									<label data-icon="g"> What is the reason you cannot achieve your goal? </label><br>
									<input list="notgoal" name="notgoal" placeholder="eg. It's boring" required>
										<datalist id="notgoal">
											<option value="The page does not work well"></option>
											<option value="Do not find appropriate information"></option>
											<option value="Find boring"></option>
											<option value="Other"></option>
											<option value="None"></option>
										</datalist>
								</p>				
                                <p> 
                                    <label> Suggestions </label>
                                    <textarea name="suggestions" min="50" rows="4" cols="60" required/></textarea> 
                                </p>
                                <p class="login button"> 
                                    <input type="submit" name="send" value="Send"/> 
								</p>
                            </form>
                        </div>
                    </div>
               
            </section>
			</div>
		</div>

	<br><br><br><br><br><br><br><br><br><br><br><br>
	
	<?php include('../header/footer.php'); ?>
	
	<?php }
else
	echo "<br><br><br><br><br><br><br><br><br><br><br><br><center><font color = 'red'><h1>You cannot access this page without login.</h1></font></center>";
?>
</body>
</html>

