<?php

	session_start();
	$mysqli = mysqli_connect("localhost", "root", "", "project1");
	echo "<script type='text/javascript'> document.location.href='index.php'; alert('You have been logged out!'); </script>";
	session_destroy();

?>