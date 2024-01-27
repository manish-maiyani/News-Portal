<?php
	include('h-check_payments.php');
	include('config.php'); 

	$payment = mysqli_query($mysqli,"SELECT * FROM payment ");
	$today = date('Y-m-d');
	while($rows = mysqli_fetch_assoc($payment)){
		$pack_id = $rows['UDF2'];
		$pay_id = $rows['Payment_ID'];
		$pay_date = $rows['Payment_DT'];
		if($pack_id == 4){
			$last_date = date('Y-m-d',strtotime("+12 months", strtotime($pay_date)));
		}elseif($pack_id == 3){
			$last_date = date('Y-m-d',strtotime("+6 months", strtotime($pay_date)));
		}elseif($pack_id == 2){
			$last_date = date('Y-m-d',strtotime("+3 months", strtotime($pay_date)));
		}elseif($pack_id == 1){
			$last_date = date('Y-m-d',strtotime("+1 months", strtotime($pay_date)));
		} 
		if($last_date < $today){
			//echo 'ended';
			echo $del = 'delete from payment where Payment_ID = '.$pay_id;//die;
			mysqli_query($mysqli,$del);
		}else{
			//echo 'running';
		}
		//echo $last_date;die;
	}
	header("location:home.php");
?>
