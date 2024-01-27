<?php
	include("config.php");
	$co = mysqli_query($mysqli,"SELECT * FROM news WHERE ID='".$_GET['id']."'");
	while($cc= mysqli_fetch_assoc($co))
	{
		$cn = $cc['count'];
	}
	$cn += 1;
	mysqli_query($mysqli,"UPDATE news SET count='".$cn."' WHERE ID='".$_GET['id']."' ");
	header('Location: ' . $_GET['href']."?id=".$_GET['id']);
?>