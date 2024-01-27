<html>
<head>

<title>News Portal - Add Advertise</title>
<link rel="icon" type="image/gif/jpg" href="../images/logo-main.jpg">
<link href="../css/sli.css" type="text/css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../css/astyle.css" />
<style type="text/css">
		img{
  				width:440px;
  				max-height: 200px;
		   }
</style>
<script type='text/javascript'>
function preview_image(event) 
{
 var reader = new FileReader();
 reader.onload = function()
 {
  var output = document.getElementById('output_image');
  output.src = reader.result; 
 }
 reader.readAsDataURL(event.target.files[0]);
}
</script>

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


<?php
session_start();


if ($_SESSION['user_name'] != '')
{
	include('../header/h-add_advertise.php'); 

	if(@$_GET['action']=='update')
	{
		$id = $_GET['id'];
		$qry = "select * from advertise where Advertise_ID=$id";
		$res = mysqli_query($mysqli,$qry);
		$arr = mysqli_fetch_assoc($res);
	}
?>


<body>

	<div class="se-pre-con"></div>

		<br>
		<div id="page">
			<div id="content" class="container1">
				<section>				
               
                    <div id="wrapper1">
                        <div id="login">
                            <form  action="" method="POST" enctype="multipart/form-data"> 
                                <h1> Add Advertise </h1> 
								
								<?php
									if(isset($_POST['sub']))
									{
										//echo '<pre>';print_r($_FILES);die;
										$advertise_title = $_POST['advertise_title'];
										$advertise_image = time().$_FILES['advertise_image']['name'];
										$user_id=$_SESSION['user_id'];

										if($advertise_title == '')
										{
											$msg = "Please Enter Advertise Title!! ";
										}
										elseif ($advertise_image == '')
										{
											$msg = "Please Enter Advertise Image!!";
										}
										else
										{
											if(@$_GET['action']=='update')
											{
												if ($_FILES['advertise_image']['name']='')
												{
													$advertise_image = $arr['advertise_image'];
												}
												else
												{
													unlink("advertise/".$arr['advertise_image']);
													move_uploaded_file($_FILES['advertise_image']['tmp_name'], 'advertise/'.$advertise_image);
												}
												$qry = "update advertise set Advertise_Title='$advertise_title',Advertise_Image='$advertise_image' where Advertise_ID=$id";
											}
											else
											{	
												$sql = "INSERT INTO advertise(ID,Advertise_Title,Advertise_Image) VALUES ($user_id,'".addslashes($advertise_title)."','$advertise_image')";
												mysqli_query($mysqli,$sql);

												
							 					 move_uploaded_file($_FILES['advertise_image']['tmp_name'],'advertise/'.$advertise_image);
												echo "<center><h3><font color='red'>News submitted  successfully!</font></h3></center>";
											}
										}
											
									}
								?>

								<br>
                              
                                <p> 
                                    <label data-icon="t">Title of Advertise</label>
                                    <input name="advertise_title" type="text" placeholder="" required value="<?php echo @$arr['Advertise_Title']?>" />
                                </p>
                                
									 
								<p>
								    <label data-icon="i"> image for Advertise</label>
									<input name="advertise_image" type="file" accept="" onchange="preview_image(event)" type="file" required/>
									<img id="output_image"/>
									<?php
									if (isset($arr['Advertise_Image']))
								    { ?>
										<img src="advertise/<?php echo @$arr['Advertise_Image']?>">
									<?php }?>
								</p>
                                <p class="signin button"> 
									<input type="submit" name="sub" value="Add"/> 
								</p>
                            </form>
                        </div>
                    </div>
               
            </section>
			</div>
		</div>
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

	<?php include('../header/footer.php'); ?>
	
	<?php }
else
	echo "<br><br><br><br><br><br><br><br><br><br><br><br><center><font color = 'red'><h1>You cannot access this page without login.</h1></font></center>";
?>
</body>
</html>

