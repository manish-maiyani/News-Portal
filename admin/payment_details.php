<html>
<head>

<title>News Portal - Home</title>
<link rel="icon" type="image/gif/jpg" href="../images/logo-main.jpg">
<link rel="stylesheet" type="text/css" href="../css/ahstyle.css" />
<link href="../css/main.css" type="text/css" rel="stylesheet">
<link href="../css/pagination.css" type="text/css" rel="stylesheet">
<style>
table, th, td {
    border: 1px solid #8EBEAE;
}

</style>

</head>

<body>

<?php
	include('h-payment.php'); 
	include('config.php'); 
	$cat = mysqli_query($mysqli,"SELECT * FROM payment p join registration r on p.UDF1=r.ID  ORDER BY ID DESC");
?>
<div class="container"> 
	<div id="wrapper1">
        <h1>View Payment Details</h1>   
	</div>    
    	
	<br><br><br><br><br><br><br>
	<table cellpadding="7" width="100%">
		<tr>
			<th><font color="#8EBEAE"><h4><b><br>NO.</b></h4></font></th>
			<th><font color="#8EBEAE"><h4><b><br>USERNAME</b></h4></font></th>
			<th><font color="#8EBEAE"><h4><b><br>EMAIL</b></h4></font></th>
			<th><font color="#8EBEAE"><h4><b><br>TRANSACTION_ID</b></h4></font></th>
			<th><font color="#8EBEAE"><h4><b><br>AMOUNT</b></h4></font></th>
			<th><font color="#8EBEAE"><h4><b><br>PHONE NO.</b></h4></font></th>
			<th><font color="#8EBEAE"><h4><b><br>STATUS</b></h4></font></th>
			<th><font color="#8EBEAE"><h4><b><br>PAYMENT_DT</b></h4></font></th>
		
		<?php 
            
			$i=0;

	    	if($_SERVER['REQUEST_URI'] == '/External_Final_07_01/admin/index.php' || $_SERVER['REQUEST_URI'] == '/External_Final_07_01/admin/')
			{
				$page1 = 0;
				$page = 1;
			}
			else
			{
				$page = isset($_GET['page']) ? $_GET['page'] : 1;
				$page1 = ($page*6)-6;
				$page2 = ($page*6)-5;
			}
			$cat = mysqli_query($mysqli,"SELECT * FROM payment p join registration r on p.UDF1=r.ID  ORDER BY ID DESC limit $page1,6");
			$i=$page2;
            while($row = mysqli_fetch_assoc($cat)) 
            {				
        ?>
        
		<tr align="center">
            <td><?php  echo  $i; ?></td>
            <td><?php  echo  $row['Username'];?></td>
			<td><?php  echo  $row['Email']; ?></td>
            <td><?php  echo  $row['Transaction_ID']; ?></td>
            <td><?php  echo  $row['Amount']; ?></td>
            <td><?php  echo  $row['Phone_No'];?></td>	
            <td><?php  echo  $row['Status'];?></td>
			<td><?php  echo  $row['Payment_DT'];?></td>					
            
        </tr>
       
	   <?php $i++; }?>
	   
	</table>
 	</div>
<br><br><br><br>

<?php
	$cat = mysqli_query($mysqli,"SELECT * FROM payment p join registration r on p.UDF1=r.ID ");
	$r = mysqli_num_rows($cat);
	$a = ceil($r/6);
	?>

	<center>
	<div class='pa'>
    <div class='pagination'>
    
    <?php
    	$far = array(1,2,3);
    	$lar = array($a,$a-1,$a-2);
    	
    	if(!in_array($page, $far) && $a>5) 
		{ ?>
			<a href = "payment_details.php?page=1"> << </a>
		<?php }

     	if($page<=3)
     	{
     		if($a>=5)
     			$s = 5;
     		else
     			$s = $a;
     		for($b=1 ; $b <= $s ; $b++)
			{?>	
				<a href = "payment_details.php?page=<?php echo $b; ?>" <?php if($page == $b) { echo ' class="active"'; } ?> > <?php echo $b." "; ?> </a>
			<?php }
		}
		
		elseif (in_array($page, $lar) && $page<=$a) 
		{
			$pp=$a;

			if($page == $a && $a>=5)
			{
			 	for($b=$pp-4 ; $b <= $a ; $b++)
				{?>	
					<a href = "payment_details.php?page=<?php echo $b; ?>" <?php if($page == $b) { echo ' class="active"'; } ?> > <?php echo $b." "; ?> </a>
				<?php }
			}
			else
			{
				if($a<5)
				{
					$pp++;
					for($b=$pp-4 ; $b <= $a ; $b++)
					{?>	
						<a href = "payment_details.php?page=<?php echo $b; ?>" <?php if($page == $b) { echo ' class="active"'; } ?> > <?php echo $b." "; ?> </a>
					<?php }
				}
				else
				{
					for($b=$pp-4 ; $b <= $a ; $b++)
					{?>	
						<a href = "payment_details.php?page=<?php echo $b; ?>" <?php if($page == $b) { echo ' class="active"'; } ?> > <?php echo $b." "; ?> </a>
					<?php }
				}
			}
		} 
		else
		{ 
			for($b=max(1, $page - 2) ; $b <= min($page + 2, $a) ; $b++)
			{?>	
				<a href = "payment_details.php?page=<?php echo $b; ?>" <?php if($page == $b) { echo ' class="active"'; } ?> > <?php echo $b." ";?>  </a>
			<?php } 
			
		}

		if(!in_array($page, $lar) && $a>5) 
			{?>
				<a href = "payment_details.php?page=<?php echo $a; ?>"> >> </a>
		<?php }
	?>	
</div>
</div>
</center><br><br><br><br>
<br><br><br><br>


</body>
</html>
