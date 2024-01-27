<?php

	include("config.php");
	
	mysqli_query($mysqli, "DELETE FROM Categories WHERE id='".$_GET['id']."'");
	echo "<script type='text/javascript'> document.location.href='viewcategories.php'; alert('You have successfully deleted one News Category!'); </script>";

?>

