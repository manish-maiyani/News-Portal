<html>
<head>

<title>News Portal - Account</title>
<link rel="icon" type="image/gif/jpg" href="images/logo-main.jpg" />
<link rel="stylesheet" type="text/css" href="css/style.css" />

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
	background: url(images/Preloader_2.gif) center no-repeat #fff;
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

	<?php include('header/h-account.php');?>
	<br>
	
		<div id="page">
			<div id="content" class="container1">
				<section>				
                <div id="container_demo1" >
                    <a class="hiddenanchor" id="toregister"></a>
                    <a class="hiddenanchor" id="tologin"></a>
                    <div id="wrapper1">
                        <div id="login" class="animate form">
                            <form  action="" method="POST"> 
                                <h1>Log in</h1> 
								
								<?php
									if(isset($_POST['login']))
									{
										session_start();
										$mysqli = mysqli_connect("localhost:3306", "root", "", "project1"); 		
										$paa = md5($_POST['lpass']);
										$query = mysqli_query($mysqli,"SELECT * FROM registration WHERE  Email='".$_POST['luser']."' and Password='$paa'");
											
										if(mysqli_num_rows($query)==1)
										{
											while ($row = mysqli_fetch_assoc($query))
											{
												$_SESSION['user_id'] = $row['ID'];
												$_SESSION['user_name'] = $row['Username'];
												$_SESSION['mmail'] = $row['Email'];
												$_SESSION['ps'] = $row['Password'];
												$_SESSION['mob'] = $row['Mobile_No'];
												$_SESSION['i_path'] = $row['Image_Path'];
												$_SESSION['UL']=$row['ULI_DT'];
											}
											if(!empty($_POST["rem"])) 
											{
												setcookie ("username",$_POST["luser"],(time()+ (365 * 24 * 60 * 60)));
												setcookie ("password",$_POST["lpass"],(time()+ (365 * 24 * 60 * 60)));
												setcookie ("remember",$_POST["rem"],(time()+ (365 * 24 * 60 * 60)));
											}
											else 
											{
												setcookie("username","");
												setcookie("password","");
												setcookie("remember","");
											}
											$s= date('Y-m-d H:i:s',strtotime('+4 hour +30 minutes'));
											mysqli_query($mysqli,"UPDATE registration SET ULI_DT='$s' WHERE ID='".$_SESSION['user_id']."'");
											header("location:user/home.php");
										}
										else
											echo "<center><h3><font color='red'>Incorrect E-mail or Password!</font></h3></center>";  										
									}
								?>
                                
								<p>
                                    <label data-icon="u" > Your E-mail </label>
                                    <input name="luser" required="required" type="text" placeholder="mymail@mail.com" value="<?php if(isset($_COOKIE["username"])) { echo $_COOKIE["username"]; } ?>"/>
                                </p>
                                <p> 
                                    <label data-icon="p"> Your Password </label>
                                    <input name="lpass" required="required" type="password" placeholder="eg. X8df!90EO" value="<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>"/> 
                                </p>
								<p class="keeplogin"> 
									<input type="checkbox" name="rem" <?php if(isset($_COOKIE["remember"])) { ?> checked <?php } ?>/> 
									<label>Keep me logged in</label>
								</p>
                                <p class="login button"> 
                                    <input type="submit" name="login" value="Login"/> 
								</p>
                                <p class="change_link">
									Not a member yet ?
									<a href="#toregister" class="to_register">Join us</a>
								</p>
                            </form>
                        </div>

                        <div id="register" class="animate form">
                            <form  action="" method="POST" enctype="multipart/form-data"> 
                                <h1> Sign up </h1> 
								
								<?php
									if(isset($_POST['signup']))
									{
										$mysqli = mysqli_connect("localhost", "root", "", "project1");
										$query = mysqli_query($mysqli,"SELECT * FROM registration WHERE Email='".$_POST['semail']."'");
										$un	= $_POST['sname'];
									
										if(mysqli_num_rows($query)==1)
											echo "<center><h3><font color='red'>E-mail is already used!</font></h3></center><br>";
		
										elseif($_POST['spass'] != $_POST['scpass'])
											echo "<center><h3><font color='red'>Password doesn't match!</font></h3></center><br>";
																			
										elseif(!preg_match("/^[a-zA-Z0-9 ]+$/",$un)) 
										{
										    echo "<center><h3><font color='red'>Username should have been in proper format!</font></h3></center><br>";
										}

										else
										{
											$name = $_FILES['file']['name'];
											$target_dir = "upload/";
											$target_file = $target_dir . basename($_FILES["file"]["name"]);

											// Select file type
											$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

											// Valid file extensions
											$extensions_arr = array("jpg","jpeg","png","gif");

											// Check extension
											if( in_array($imageFileType,$extensions_arr) )
											{
												$sub = "Welcome to News Portal, ".$_POST['sname'];											
												$msg = "\nHello ".$_POST['sname'].",\n\n\nThis email is to inform you that your account was successfully activated. \n\n\nHere is your account information (please keep this email for future record): \n\nYour Email: ".$_POST['semail']."\nPassword: ".$_POST['spass']." (keep it secret) \n\n\nSincerely, \nNews Portal";

												if(mail($_POST['semail'], $sub, $msg))
    											{
    												$pa = md5($_POST['spass']);
													// Insert record
													$u = mysqli_query($mysqli,"INSERT INTO registration (Username, Email, Main_Pass, Password, Image_Path, RLI_DT)
														VALUES ('".$_POST['sname']."','".$_POST['semail']."','".$_POST['spass']."','$pa','$target_file',now())");

													move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);	
													echo "<script type='text/javascript'> document.location.href='account.php#tologin'; alert('You have successfully created account!'); </script>";
													//header("location:index.php#tologin");
												}
												else
   											    {
     												print_r("<center><h3><font color='red'>".error_get_last()."</font></h3></center><br>");
    											}
											}
										}
									}
								?>
								<br>
								
                                <p> 
                                    <label data-icon="u">Your Username</label>
                                    <input name="sname" required="required" type="text" placeholder="mysuperusername690" />
                                </p>
                                <p> 
                                    <label data-icon="e" > Your E-mail</label>
                                    <input name="semail" required="required" type="email" placeholder="mysupermail@mail.com"/> 
                                </p>
                                <p> 
                                    <label data-icon="p">Your Password </label>
                                    <input name="spass" required="required" type="password" placeholder="eg. X8df!90EO"/>
                                </p>
                                <p> 
                                    <label data-icon="p">Confirm your Password </label>
                                    <input name="scpass" required="required" type="password" placeholder="eg. X8df!90EO"/>
                                </p>                              
								<p>
								    <label data-icon="u">Profile Picture </label>
									<input name="file" type="file" required="required"/>
								</p>
                                <p class="signin button"> 
									<input type="submit" name="signup" value="Sign up"/> 
								</p>
                                <p class="change_link">  
									Already a member ?
									<a href="#tologin" class="to_register"> Go and log in </a>
								</p>
                            </form>
                        </div>
						
                    </div>
                </div>  
            </section>
			</div>
		</div>
		<br>
<?php include('header/vfooter.php'); ?>

		
</body>
</html>
