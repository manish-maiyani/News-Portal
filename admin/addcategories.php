<html>
<head>

<title>News Portal - Add Categories</title>
<link rel="icon" type="image/gif/jpg" href="../images/logo-main.jpg">
<link rel="stylesheet" type="text/css" href="../css/astyle.css" />

</head>

<body>

<?php
if($_GET['id'] != '')
{
	include('h-cat_news.php'); 
 	include('config.php'); 
	$cat = mysqli_query($mysqli,"SELECT * FROM categories where id='".$_GET['id']."'");
	while($row = mysqli_fetch_assoc($cat)) 
	{
?>

	<div id="wrapper1">
                        <div id="login">
                            <form  action="" method="POST"> 
                                <h1> Add Category </h1> 
								<?php
									if(isset($_POST['add']))
									{
										mysqli_query($mysqli,"UPDATE Categories SET Categories_Type = '".$_POST['cname']."' WHERE id='".$_GET['id']."'");
										echo "<script type='text/javascript'> document.location.href='viewcategories.php'; alert('You have updated name of News Category!'); </script>";
								
									}	
								?>
								<br>
								
                                <p> 
                                    <label data-icon="c">Add Category Name </label>
                                    <input name="cname" required="required" type="text" value="<?php echo $row['Categories_Type'];?>" />
                                </p>
                              
                                <p class="signin button"> 
									<input type="submit" name="add" value="Update"/> 
								</p>
                            </form>
                        </div>
                    </div>

		<?php } } 

            else
            {
                include('h-cat_news.php'); 
                ?>
					<div id="wrapper1">
                        <div id="login">
                            <form  action="" method="POST"> 
                                <h1> Add Category </h1> 
								<?php
									include('config.php');
									if(isset($_POST['add']))
									{
										mysqli_query($mysqli,"INSERT INTO Categories (Categories_Type) VALUES ('".$_POST['cname']."')");
										echo "<script type='text/javascript'> document.location.href='viewcategories.php'; alert('You have successfully added new News Category!'); </script>";
									}	
								?>
								<br>
								
                                <p> 
                                    <label data-icon="c">Add Category Name </label>
                                    <input name="cname" required="required" type="text" placeholder="Add Category Name"/>
                                </p>
                              
                                <p class="signin button"> 
									<input type="submit" name="add" value="Add"/> 
								</p>
                            </form>
                        </div>
                    </div>
                    <?php } ?>
</body>
</html>
