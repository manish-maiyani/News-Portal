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
$msg = isset($_GET['msg']) ? $_GET['msg'] : "";
if ($_SESSION['user_name'] != '')
{
    include('../header/h-edit_profile.php'); 
    
    if(isset($_POST['submit']))
    {
        $cname = $_POST['cname'];
        $cpass = $_POST['cpass'];
        $ccpass = $_POST['ccpass'];
        $img = $_FILES['file']['name'];
        $img_arr = explode('.', $img);
        $ext = end($img_arr);
        $extensions_arr = array("jpg","jpeg","png","gif");
        if($cname == ""){
            $msg  = "<center><h3><font color='red'>Username is Required!</font></h3></center>";
        }else if(!preg_match("/^[a-zA-Z0-9 ]+$/",$_POST['cname'])){
            $msg = "<center><h3><font color='red'>Username should have been in proper format!</font></h3></center>";
        }else if(($cpass != "" || $ccpass != "") && $cpass != $ccpass){
            if($cpass == ""){
                $msg = "<center><h3><font color='red'>Please enter New Password field.</center></h3></font>";    
            }else if($ccpass == ""){
                $msg ="<center><h3><font color='red'>Please enter Re-Type New Password field.</center></h3></font>";
            }else{
                $msg ="<center><h3><font color='red'>Password doesn't match.</center></h3></font>";
            }
            
        }else if($img != "" && !in_array($ext, $extensions_arr)){
            $msg = "<center><h3><font color='red'>File is not in valid format!.</center></h3></font>";
        }else{
            $target_dir = "../upload/";
            $qry = "UPDATE registration SET Username='".$_POST['cname']."'";
            if($cpass != "" || $ccpass !=""){
                $qry .=",Main_Pass='$cpass',Password='".md5($cpass)."'";
            }
            if($img!= ""){
                $string=substr($target_dir,3);
                $target_file = $string . basename($img);
                $qry .=",Image_Path='".$target_file."'";
            }
            $qry .= " where ID=".$_SESSION['user_id'];
            $qry = mysqli_query($mysqli,$qry);
            move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$img);  
            $query = mysqli_query($mysqli,"SELECT * FROM registration WHERE ID='".$_SESSION['user_id']."'");
            $count = mysqli_num_rows($query);
            $msg = "<center><h3><font color='red'>You successfully changed your profile!</center></h3></font>";
            if($count==1)
            {
                while ($row = mysqli_fetch_assoc($query))
                {                   
                    $_SESSION['user_name'] = $row['Username'];
                    $_SESSION['ps'] = $row['Password'];
                    $_SESSION['i_path'] = $row['Image_Path'];
                    header("location:edit_profile.php?msg=$msg");
                }   
            }
        }
        
    }
    
    
    mysqli_close($mysqli);
?>

<title>News Portal - Edit Profile</title>
<link rel="stylesheet" type="text/css" href="../css/astyle.css" />

</head>

<body>

<div class="se-pre-con"></div>
    
	<br>
		<div id="page">
			<div id="content" class="container1">
				<section>				
               
                    <div id="wrapper1">
                        <div id="login">
                            <form  action="edit_profile.php" method="POST" enctype="multipart/form-data"> 
                                <h1> Edit Profile </h1> 
                                <?php 
                                    if (isset($msg))
                                    {
                                        echo $msg;
                                    }
                                ?>

                                <p> 
                                    <label data-icon="u">Change Username</label>
                                    <input name="cname" required="required" type="text" value="<?php echo $_SESSION['user_name']; ?>"/>
                                </p>
                                <p> 
                                    <label data-icon="e" > Email</label>
                                    <input disabled type="email" value="<?php echo $_SESSION['mmail']; ?>" /> 
                                </p>
                                <p> 
                                    <label data-icon="e" > Mobile Number</label>
                                    <input disabled type="text" value="<?php echo $_SESSION['mob']; ?>" /> 
                                </p>
                                <p> 
                                    <label data-icon="p">New password </label>
                                    <input name="cpass" type="password"/>
                                </p>
								 <p> 
                                    <label data-icon="p">Re-Type New password </label>
                                    <input name="ccpass" type="password"/>
                                </p>
								<p>
								    <label data-icon="u">Change Profile Picture </label>
									<input name="file" type="file"/>
								</p>
                                <p class="signin button"> 
									<input type="submit" name="submit" value="Submit"/> 
								</p>
                            </form>
                        </div>
                    </div>
               
            </section>
			</div>
		</div>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
	
	<?php include('../header/footer.php'); ?>
	
	<?php }
		else
			echo "<br><br><br><br><br><br><br><br><br><br><br><br><center><font color = 'red'><h1>You cannot access this page without login.</h1></font></center>";
	?>
</body>
</html>

