<?php

	include("config.php");
	if(isset($_GET['rid']))
	{
		$id = $_GET['rid'];
		$sql_sel = "select * from news where ID=$id";
		$res_sel = mysqli_query($mysqli,$sql_sel);
		$img_row = mysqli_fetch_assoc($res_sel);
		//echo $img_row['Image_Path'];die;
		unlink('../user/'.$img_row['Image_Path']);
		mysqli_query($mysqli, "DELETE FROM news WHERE id='".$_GET['rid']."'");
		echo "<script type='text/javascript'> document.location.href='viewreqnews.php'; alert('You have successfully deleted one Requested News!'); </script>";
	}
	
	$id = $_GET['id'];
	$sql_sel = "select * from news where ID=$id";
	$res_sel = mysqli_query($mysqli,$sql_sel);
	$img_row = mysqli_fetch_assoc($res_sel);
	//echo $img_row['Image_Path'];die;
	unlink('../user/'.$img_row['Image_Path']);
	mysqli_query($mysqli, "DELETE FROM news WHERE id='".$_GET['id']."'");
	echo "<script type='text/javascript'> document.location.href='viewdelnews.php'; alert('You have successfully deleted one Requested News!'); </script>";
?>

