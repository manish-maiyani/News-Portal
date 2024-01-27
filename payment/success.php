<?php
include('../header/config.php');
session_start();
$firstname=$_POST["firstname"];
$amount=$_POST["amount"];
$txnid=$_POST["txnid"];
$posted_hash=$_POST["hash"];
$key=$_POST["key"];
$status=$_POST["status"];
$productinfo=$_POST["productinfo"];
$email=$_POST["email"];
$payment_time=$_POST["addedon"];
$phone_no=$_POST["phone"];
$udf1=$_SESSION["user_id"];
$udf2=$_SESSION["pack_id"];
$salt="hWDqztfBes";
//echo '<pre>';print_r($_POST);die;
// Salt should be same Post Request 
$qry = "insert into payment (Username,Email,Transaction_ID,Amount,phone_No,UDF1,UDF2,Status,Payment_DT)
          values ('$firstname','$email','$txnid','$amount','$phone_no','$udf1','$udf2','$status','$payment_time')";
//die;
          if(mysqli_query($mysqli,$qry))
          {
            echo "<script type='text/javascript'> document.location.href = '../user/home.php'; alert('We have received a payment of Rs. " . $amount . ". Your transaction is successfully done!!'); </script>";
          }else
          {
            echo "error.".mysqli_error($mysqli);
          }


If (isset($_POST["additionalCharges"])) {
       $additionalCharges=$_POST["additionalCharges"];
        $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
  } else {
        $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
         }
		 $hash = hash("sha512", $retHashSeq);
       if ($hash != $posted_hash) {
	       echo "Invalid Transaction. Please try again";
		   } else {
          
          // echo "<h3>Thank You. Your order status is ". $status .".</h3>";
          // echo "<h4>Your Transaction ID for this transaction is ".$txnid.".</h4>";
          // echo "<h4>We have received a payment of Rs. " . $amount . ". Your order will soon be shipped.</h4>";
		   }
       
?>	