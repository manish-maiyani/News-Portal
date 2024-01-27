<html>
<head>

<title>News Portal - UPLOAD NEWS</title>
<link rel="icon" type="image/gif/jpg" href="../images/logo-main.jpg">
<link rel="stylesheet" type="text/css" href="../css/astyle.css" />

</head>

<body>

<?php
if($_GET['id'] != '')
{
	include('h-cat_news.php'); 
	include('config.php'); 
	$cat = mysqli_query($mysqli,"SELECT * FROM news where Status = 'Pending' AND id='".$_GET['id']."'");
	while($row = mysqli_fetch_assoc($cat)) 
    {		$email = $row['Email'];
			$ipath = $row['Image_Path'];
			$aa = mysqli_query($mysqli,"SELECT * FROM categories WHERE ID = '".$row['Cat_ID']."'");		
            while($res = mysqli_fetch_assoc($aa))
            {         		
?>
        
        <div id="wrapper1">
                        <div id="login">
                            <form  action="" method="POST"> 
                                <h1> Upload News </h1> 
								
								<?php
									if(isset($_POST['sub']))
									{
										$a = mysqli_query($mysqli,"SELECT * FROM categories WHERE Categories_Type = '".$_POST['cat']."'");	
						            	while($res = mysqli_fetch_assoc($a))
						            	{
						            		$c = $res['ID'];
						            	}

										$s= date('Y-m-d H:i:s',strtotime('+4 hour +30 minutes'));
										mysqli_query($mysqli, "UPDATE news SET Status = 'Active', DT = '$s' WHERE id='".$_GET['id']."'");
							 			echo "<script type='text/javascript'> document.location.href='viewupnews.php'; alert('You have successfully uploaded one news!'); </script>";
									}
								?>

								<br>
								<p> 
                                    <label data-icon="c"> Category </label><br>
                                    <input list="cat" name="cat"required="required" value="<?php echo $res['Categories_Type'];?>">
										<datalist id="cat">
											<?php
									    	include('config.php');
											$cat = mysqli_query($mysqli,"SELECT * FROM Categories");
											while($row=mysqli_fetch_assoc($cat)) 
											{	?>
											<option value="<?php echo $row['Categories_Type'];?>"></option>
											<?php } ?>
										</datalist>
                                </p>
                              	<?php
									$cat = mysqli_query($mysqli,"SELECT * FROM news where id='".$_GET['id']."'");
									while($row = mysqli_fetch_assoc($cat)) 
								    {				
								?>
                                <p> 
                                    <label data-icon="t">Title of News</label>
                                    <input name="title" required="required" type="text" value="<?php echo $row['Title'];?>" />
                                </p>
                                <p> 
                                    <label> Description</label>
									<textarea name="desc" type="text" rows="4" cols="60" /><?php  echo  $row['Description']; ?></textarea> 
                                </p>
								<p>
								    <label>Upload image for News </label><br>
									<img src = "../user/<?php  echo  $row['Image_Path'];?>" width="440" height="200">
								</p>
                                <p class="signin button"> 
									<input type="submit" name="sub" value="Upload"/> 
								</p>
                            </form>
                        </div>
                    </div>
                    <br><br><br><br>
                    <?php } } } }

                    else
                    {
                    	include('h-cat_news.php'); 
                    	include('config.php');
                    	
                    ?>

                    	<div id="wrapper1">
                        <div id="login">
                            <form  action="" method="POST" enctype="multipart/form-data"> 
                                <h1> UPLOAD News </h1> 
								
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
							            	$mail = "admin@gmail.com";
											mysqli_query($mysqli,"INSERT INTO news (Email, Cat_ID, Title,Status, Description, Image_Path, DT)
											VALUES ('$mail','$c','".addslashes($_POST['title'])."','Active','".addslashes($_POST['desc'])."','$target_file',now())");
							 				$pd = "../user/news/";
							 				$p = $pd.$name;
											move_uploaded_file($_FILES['support_images']['tmp_name'],$p);	

											echo "<script type='text/javascript'> document.location.href='viewupnews.php'; alert('You have successfully uploaded one news!'); </script>";
										}	
									}
								?>

								<br>
								<p> 
                                    <label data-icon="c"> Category </label><br>
                                    <input list="cat" name="cat"required="required" placeholder="eg. Sports/Crime">
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
                                    <input name="title" required="required" type="text" placeholder="eg. Unwanted attack!!" />
                                </p>
                                <p> 
                                    <label> Description</label>
									<textarea name="desc" type="text" rows="4" cols="60" /></textarea> 
                                </p>
								<p>
								    <label>Upload image for News </label><br>
									<input name="support_images" required="required" type="file">
								</p>
                                <p class="signin button"> 
									<input type="submit" name="sub" value="Upload"/> 
								</p>
                            </form>
                        </div>
                    </div>
                    <br><br><br><br>
                    <?php  } ?>

</body>
</html>
