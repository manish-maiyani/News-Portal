<html>
<head>

<title>News Portal - View Categories</title>
<link rel="icon" type="image/gif/jpg" href="../images/logo-main.jpg">
<link rel="stylesheet" type="text/css" href="../css/ahstyle.css" />
<style>
table, th, td {
    border: 1px solid #8EBEAE;
}
</style>
</head>

<body>

<?php
	include('h-cat_news.php'); 
	include('config.php'); 
	$cat = mysqli_query($mysqli,"SELECT * FROM Categories");
?>

	<div id="wrapper1">
        <h1>View Categories</h1>                      
	</div>
	
	<br><br><br><br><br><br>
	<table width="50%" align="center" cellpadding="10">
		<tr>
			<th><font color="#8EBEAE"><h4><b><br>NO.</b></h4></font></th>
			<th><font color="#8EBEAE"><h4><b><br>CATEGORY TYPE</b></h4></font></th>
			<th><font color="#8EBEAE"><h4><b><br>ACTION</b></h4></font></th>
		 
		<?php 
            $i=1;
            while($row = mysqli_fetch_assoc($cat)) 
            {				
        ?>
        
		<tr align="center">
            <td><?php  echo   $i; ?></td>
            <td><?php  echo  $row['Categories_Type'];?></td>			
            <td><a href="addcategories.php?id=<?php echo $row['ID'];?>&action=Update"><font color="red">UPDATE</font></a> || <a href="cat_delete.php?id=<?php echo $row['ID']; ?>" onclick="return confirm('Are you sure, you want to delete it?')"><font color="red">DELETE</font></a></td>
        </tr>
       
	   <?php $i++; }?>
	   
	</table>

<br><br><br><br>
</body>
</html>
