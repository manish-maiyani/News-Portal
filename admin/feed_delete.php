<?php

	include("config.php");
	mysqli_query($mysqli, "DELETE FROM feedback WHERE id='".$_GET['id']."'");
	echo "<script type='text/javascript'> document.location.href='view_feedback.php'; alert('You have successfully deleted one Feedback!'); </script>";
?>

