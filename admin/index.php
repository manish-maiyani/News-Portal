<html>
<head>

<title>News Portal - Admin</title>
<link rel="icon" type="image/gif/jpg" href="../images/logo-main.jpg">
<link rel="stylesheet" type="text/css" href="../css/astyle.css" />

</head>

<body>
	
	<?php include('../header/h-admin.php'); ?>
	<br>
		<div id="page">
			<div id="content" class="container1">
				<section>				
               
                    <div id="wrapper1">
                        <div id="login">
                            <form action="" autocomplete="on" method="POST"> 
                                <h1>Log in</h1> 
								
								<?php
								session_start();
								if(isset($_SESSION['admin_id']))
								{
									header("location:home.php");
								}
								$mysqli = mysqli_connect("localhost", "root", "", "project1"); 	
									if(isset($_POST['alogin']))
									{
										
										$query = mysqli_query($mysqli,"SELECT * FROM admin WHERE Username='".$_POST['user']."' and Password='".$_POST['pass']."'");
	
										if(mysqli_num_rows($query)==1)
										{

											$row=mysqli_fetch_assoc($query);
											$_SESSION['admin_id']=$row['ID'];
											//echo '<pre>';print_r($row);die;
											header("location:home.php");
										}
										else											
											echo "<center><h3><font color='red'>Incorrect Username or Password!</font></h3></center>";  
									}
								?>
								<br>
								
                                <p> 
                                    <label class="uname" data-icon="u" > Your Username </label>
                                    <input name="user" required="required" type="text" placeholder="myusername"/>
                                </p>
                                <p> 
                                    <label class="youpasswd" data-icon="p"> Your Password </label>
                                    <input name="pass" required="required" type="password" placeholder="eg. X8df!90EO" /> 
                                </p>
                                <p class="login button"> 
                                    <input type="submit" name="alogin" value="Login"/> 
								</p>
                            </form>
                        </div>
                    </div>
               
            </section>
			</div>
		</div>

	
</body>
</html>
