<html>
<head>
<link rel="icon" type="image/gif/jpg" href="../images/logo-main.jpg">

<?php
session_start();
if ($_SESSION['user_name'] != '')
{
	include('../header/h-news.php'); 
?>

<title>News Portal - Request for News</title>
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

<body>

<div class="se-pre-con"></div>
	
		<br>
		<div id="page">
			<div id="content" class="container1">
				<section>				
               
                    <div id="wrapper1">
                        <div id="login">
                            <form  action="" method="POST" enctype="multipart/form-data"> 
                                <h1> Request For News </h1> 
								
								<?php
									if(isset($_POST['sub']))
									{
										$name = $_FILES['support_images']['name'];
										$target_dir = "news/";
										$target_file = $target_dir . basename($_FILES["support_images"]["name"]);

											// Select file type
											$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

											// Valid file extensions
											$extensions_arr = array("jpg","jpeg","png","gif");
											// Check extension
											if( in_array($imageFileType,$extensions_arr) )
											{
												$a = mysqli_query($mysqli,"SELECT * FROM categories WHERE Categories_Type = '".$_POST['cat']."'");	
								            	while($res = mysqli_fetch_assoc($a))
								            	{
								            		$c = $res['ID'];
								            	}

												mysqli_query($mysqli,"INSERT INTO news (Email, Cat_ID, Title,Status, Description, Image_Path, DT)
												VALUES ('".$_SESSION['mmail']."','$c','".addslashes($_POST['title'])."','Pending','".addslashes($_POST['desc'])."','$target_file',now())");
							 					move_uploaded_file($_FILES['support_images']['tmp_name'],$target_dir.$name);
												echo "<center><h3><font color='red'>News submitted successfully!</font></h3></center>";
											}
									}
								?>

								<br>
								<p> 
                                    <label data-icon="c"> Category </label><br>
                                    <input list="cat" name="cat" placeholder="eg. Sports/Crime" required>
										<datalist id="cat">
									    <?php
											$cat = mysqli_query($mysqli,"SELECT * FROM Categories");
											while($row=mysqli_fetch_assoc($cat)) 
											{	?>
											<option value="<?php echo $row['Categories_Type'];?>"></option>
											<?php } ?>
										</datalist>
                                </p>
                              
                                <p> 
                                    <label data-icon="t">Title of News</label>
                                    <input name="title" type="text" placeholder="eg. Unwanted attack!!" required/>
                                </p>
                                <p> 
                                    <label> Description</label>
									
									<div id="sample">
									  
									
									  <textarea name="desc" rows="4" cols="60"  style="max-height: 40px;" /></textarea>
									  <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> <script type="text/javascript">
							
								      bkLib.onDomLoaded(function() { nicEditors.allTextAreas({maxHeight : 100}) 
								      	
								      });
									  
									  </script>
									</div> 
                                </p>
								<p>
								    <label data-icon="i">Upload image for News</label>
									<input name="support_images" type="file" accept="image/*" onchange="preview_image(event)" type="file" required/>
									<img id="output_image"/>
								</p>
                                <p class="signin button"> 
									<input type="submit" name="sub" value="Submit"/> 
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

