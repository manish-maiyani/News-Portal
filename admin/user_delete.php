<?php

	include("config.php");
	mysqli_query($mysqli, "DELETE FROM registration WHERE id='".$_GET['id']."'");
	echo "<script type='text/javascript'> document.location.href='home.php'; alert('You have successfully deleted one User!'); </script>";
?>

