<?php
	session_start();
	include('config.php');
	$_SESSION['ULO']=date('Y-m-d H:i:s',strtotime('+4 hour +30 minutes'));
	$s= $_SESSION['ULO'];
	$l= $_SESSION['user_id'];	
	mysqli_query($mysqli,"UPDATE registration SET ULO_DT='$s' WHERE ID='$l'");
	
	echo "<script type='text/javascript'> document.location.href='../account.php'; alert('You have been logged out!'); </script>";
	session_destroy();
?>