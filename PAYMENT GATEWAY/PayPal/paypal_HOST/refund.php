<?php
session_start();
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Untitled Document</title>
<style type="text/css">
.transaction_info {margin:0px auto; background:#F2FCFF;; max-width: 750px; color:#555;font-size: 13px;font-family: Arial, sans-serif;}
.transaction_info thead {background: #BCE4FA;font-weight: bold;}
.transaction_info thead tr th {border-bottom: 1px solid #ddd;}
</style>
</head>
<body>
<div align="center"><h2>Payment Success</h2></div>
<table border="0" cellpadding="10" cellspacing="0" class="transaction_info">
<thead><tr>
<td>Transaction ID</td>
<td>Date</td><td>Currency</td>
<td>Amount</td><td>Method</td>
<td>State</td>
<td>Action</td></tr></thead>
<tbody>
	<?php 
	$mysqli = mysqli_connect("localhost", "id6971136_root", "HKschool6638@@", "id6971136_project");
$cat = mysqli_query($mysqli,"SELECT * FROM paypal");
	while($row = mysqli_fetch_assoc($cat)) 
            { ?>
<tr> 
<td><?php  echo  $row['Tran_ID'];?></td>
<td><?php  echo  $row['DT'];?></td>
<td><?php  echo  $row['Currency'];?></td>
<td><?php  echo  $row['Amount'];?></td>
<td><?php  echo  $row['Method'];?></td>
<td><?php  echo  $row['State'];?></td>
<td><a href="refund_process.php?id=<?php echo $row['ID']; ?>" onclick="return confirm('Are you sure, you want to refund?')"><font color="red">REFUND</font></a></td></tr><?php } ?></tbody></table>
<br><br><br>
<a href="index.php"><font color="red"><h1>HOME</h1></font></a>
</body></html>	
