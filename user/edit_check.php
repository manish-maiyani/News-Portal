<!-- <?php

	session_start();
	include('config.php');
	
	if($_POST['cpass'] == '' || $_POST['ccpass'] == '' || $_FILES['file']['name'] == '')
	{
		if(($_POST['cpass'] == '' && $_POST['ccpass'] == '') && $_FILES['file']['name'] == '')
		{
			if(!preg_match("/^[a-zA-Z0-9 ]+$/",$_POST['cname'])) 
				echo "Username should have been in proper format!";

			else
			{
				$qry = mysqli_query($mysqli,"UPDATE registration SET Username='".$_POST['cname']."', Password='".$_SESSION['ps']."', Image_Path='".$_SESSION['i_path']."' WHERE ID='".$_SESSION['user_id']."'");
				$query = mysqli_query($mysqli,"SELECT * FROM registration WHERE ID='".$_SESSION['user_id']."'");
				$count = mysqli_num_rows($query);
				
				if($count==1)
				{
					while ($row = mysqli_fetch_assoc($query))
					{					
						$_SESSION['user_name'] = $row['Username'];
						$_SESSION['ps'] = $row['Password'];
						$_SESSION['i_path'] = $row['Image_Path'];
						header("location:edit_profile.php");
					}	
				}
			}	
		}
			
		elseif(($_POST['cpass'] == '' && $_POST['ccpass'] == '') && $_FILES['file']['name'] != '')
		{
			if(!preg_match("/^[a-zA-Z0-9 ]+$/",$_POST['cname'])) 
				echo "Username should have been in proper format!";

			else
			{
				$name = $_FILES['file']['name'];
				$target_dir = "../upload/";
				$string = "../upload/";
				$string=substr($string,3);
				$target_file = $string . basename($_FILES["file"]["name"]);

				// Select file type
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

				// Valid file extensions
				$extensions_arr = array("jpg","jpeg","png","gif");
				// Check extension
				if( in_array($imageFileType,$extensions_arr) )
				{
					// Insert record
					$qryy = mysqli_query($mysqli,"UPDATE registration SET Username='".$_POST['cname']."', Password='".$_SESSION['ps']."', Image_Path='$target_file' WHERE ID='".$_SESSION['user_id']."'");
					$query = mysqli_query($mysqli,"SELECT * FROM registration WHERE ID='".$_SESSION['user_id']."'");
					$count = mysqli_num_rows($query);
		
					if($count==1)
					{
						while ($row = mysqli_fetch_assoc($query))
						{
							$_SESSION['user_name'] = $row['Username'];
							$_SESSION['ps'] = $row['Password'];
							$_SESSION['i_path'] = $row['Image_Path'];
						}
					}	
					move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);	
					header("location:edit_profile.php");
				}
			}
		}
				
		elseif(($_POST['cpass'] != '' || $_POST['ccpass'] != '') && $_FILES['file']['name'] != '')
		{
			if($_POST['cpass'] == '')
				echo 'Please enter New Password field.';
			elseif($_POST['ccpass'] == '')
				echo 'Please enter Re-Type New Password field.';
			elseif($_POST['cpass'] !=  $_POST['ccpass'])
				echo "Password doesn't match.";
			elseif(!preg_match("/^[a-zA-Z0-9 ]+$/",$_POST['cname'])) 
				echo "Username should have been in proper format!";
			else
			{
				$name = $_FILES['file']['name'];
				$target_dir = "../upload/";
				$string = "../upload/";
				$string=substr($string,3);
				$target_file = $string . basename($_FILES["file"]["name"]);				

				// Select file type
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

				// Valid file extensions
				$extensions_arr = array("jpg","jpeg","png","gif");
				// Check extension
				
				if( in_array($imageFileType,$extensions_arr) )
				{
					$pp = md5($_POST['cpass']);
					$_SESSION['ps']	= $pp;
					// Insert record
					$qryy = mysqli_query($mysqli,"UPDATE registration SET Username='".$_POST['cname']."', Password='".$_SESSION['ps']."', Image_Path='$target_file' WHERE ID='".$_SESSION['user_id']."'");
					$query = mysqli_query($mysqli,"SELECT * FROM registration WHERE ID='".$_SESSION['user_id']."'");
					$count = mysqli_num_rows($query);
	
					if($count==1)
					{
						while ($row = mysqli_fetch_assoc($query))
						{
							$_SESSION['user_name'] = $row['Username'];
							$_SESSION['ps'] = $row['Password'];
							$_SESSION['i_path'] = $row['Image_Path'];
						}
					}	
					move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);	
					header("location:edit_profile.php");
				}
			}
		}
				
		else
		{
			if($_POST['cpass'] == '')
				echo 'Please enter New Password field.';
			elseif($_POST['ccpass'] == '')
				echo 'Please enter Re-TypeNew Password field.';
			elseif($_POST['cpass'] !=  $_POST['ccpass'])
				echo "Password doesn't match.";
			elseif(!preg_match("/^[a-zA-Z0-9 ]+$/",$_POST['cname'])) 
				echo "Username should have been in proper format!";
			else
			{
				$pp = md5($_POST['cpass']);
				$_SESSION['ps']	= $pp;	

				$qry = mysqli_query($mysqli,"UPDATE registration SET Username='".$_POST['cname']."', Password='".$_SESSION['ps']."', Image_Path='".$_SESSION['i_path']."' WHERE ID='".$_SESSION['user_id']."'");		
				$query = mysqli_query($mysqli,"SELECT * FROM registration WHERE ID='".$_SESSION['user_id']."'");
				$count = mysqli_num_rows($query);
				
				if($count==1)
				{
					while ($row = mysqli_fetch_assoc($query))
					{
						$_SESSION['user_name'] = $row['Username'];
						$_SESSION['ps'] = $row['Password'];
						$_SESSION['i_path'] = $row['Image_Path'];
						header("location:edit_profile.php");
					}
				}	
			}
		}
	}
	
	else
	{
		if($_POST['cpass'] == '' || $_POST['ccpass'] == '')
		{
			if($_POST['cpass'] == '' && $_POST['ccpass'] == '')
			{
				if(!preg_match("/^[a-zA-Z0-9 ]+$/",$_POST['cname'])) 
					echo "Username should have been in proper format!";

				else
				{
					$name = $_FILES['file']['name'];
					$target_dir = "../upload/";
					$string = "../upload/";
					$string=substr($string,3);
					$target_file = $string . basename($_FILES["file"]["name"]);

					// Select file type
					$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

					// Valid file extensions
					$extensions_arr = array("jpg","jpeg","png","gif");
					// Check extension
					if( in_array($imageFileType,$extensions_arr) )
					{	
						// Insert record
						$qryyy = mysqli_query($mysqli,"UPDATE registration SET Username='".$_POST['cname']."', Password='".$_SESSION['ps']."', Image_Path='$target_file' WHERE ID='".$_SESSION['user_id']."'");
						$query = mysqli_query($mysqli,"SELECT * FROM registration WHERE ID='".$_SESSION['user_id']."'");
						$count = mysqli_num_rows($query);
		
						if($count==1)
						{
							while ($row = mysqli_fetch_assoc($query))
							{
								$_SESSION['user_name'] = $row['Username'];
								$_SESSION['ps'] = $row['Password'];
								$_SESSION['i_path'] = $row['Image_Path'];
							}
						}	
						move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);	
						header("location:edit_profile.php");
					}
				}
			}
			
			elseif($_POST['cpass'] != '' || $_POST['ccpass'] != '')
			{
				if($_POST['cpass'] == '')
						echo 'Please enter New Password field.';
					elseif($_POST['ccpass'] == '')
						echo 'Please enter New Password field.';
					elseif($_POST['cpass'] !=  $_POST['ccpass'])
						echo "Password doesn't match.";
					elseif(!preg_match("/^[a-zA-Z0-9 ]+$/",$_POST['cname'])) 
						echo "Username should have been in proper format!";
					else
					{
						$pp = md5($_POST['cpass']);
						$_SESSION['ps']	= $pp;	
						
						$qry = mysqli_query($mysqli,"UPDATE registration SET Username='".$_POST['cname']."', Password='".$_SESSION['ps']."', Image_Path='".$_SESSION['i_path']."' WHERE ID='".$_SESSION['user_id']."'");
						$query = mysqli_query($mysqli,"SELECT * FROM registration WHERE ID='".$_SESSION['user_id']."'");
						$count = mysqli_num_rows($query);
						if($count==1)
						{
							while ($row = mysqli_fetch_assoc($query))
							{
								$_SESSION['user_name'] = $row['Username'];
								$_SESSION['ps'] = $row['Password'];
								$_SESSION['i_path'] = $row['Image_Path'];
								header("location:edit_profile.php");
							}
						}	
					}
			}
		}
		else
		{
			if($_POST['cpass'] !=  $_POST['ccpass'] )
				echo "Password doesn't match.";
			elseif(!preg_match("/^[a-zA-Z0-9 ]+$/",$_POST['cname'])) 
				echo "Username should have been in proper format!";
			else
			{
				$name = $_FILES['file']['name'];
				$target_dir = "../upload/";
				$string = "../upload/";
				$string=substr($string,3);
				$target_file = $string . basename($_FILES["file"]["name"]);

				// Select file type
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

				// Valid file extensions
				$extensions_arr = array("jpg","jpeg","png","gif");
				// Check extension
				if( in_array($imageFileType,$extensions_arr) )
				{
					$pp = md5($_POST['cpass']);
					$_SESSION['ps']	= $pp;	
					// Insert record
					$qryyy = mysqli_query($mysqli,"UPDATE registration SET Username='".$_POST['cname']."', Password='".$_SESSION['ps']."', Image_Path='$target_file' WHERE ID='".$_SESSION['user_id']."'");
					$query = mysqli_query($mysqli,"SELECT * FROM registration WHERE ID='".$_SESSION['user_id']."'");
					$count = mysqli_num_rows($query);
	
					if($count==1)
					{
						while ($row = mysqli_fetch_assoc($query))
						{
							$_SESSION['user_name'] = $row['Username'];
							$_SESSION['ps'] = $row['Password'];
							$_SESSION['i_path'] = $row['Image_Path'];
						}
					}	
					move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);	
					header("location:edit_profile.php");
				}
			}		
		}
	}
	mysqli_close($mysqli);
	
?>    -->