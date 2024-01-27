<?php
session_start();
include('../header/config.php');
if(!isset($_GET['pack'])){
  header('location:pricing.php');
}
$posted = array();
$pack = $_GET['pack'];
if($pack ==4){
  $price = 1000;
  $payment_info = "Yearly Pack";
}else if($pack ==3){
  $price = 700;
  $payment_info = "Half Yearly Pack";
}else if($pack ==2){
  $price = 350;
  $payment_info = "Quaterly Pack";
}else if($pack ==1){
  $price = 120;
  $payment_info = "Monthly Pack";
}
$user_id = $_SESSION['user_id'];
$_SESSION['pack_id'] = $_GET['pack'] ;
$user_sql = "select * from registration where ID = $user_id";
$user_res = mysqli_query($mysqli,$user_sql);
$row = mysqli_fetch_assoc($user_res);
$posted['amount'] = $price;
$posted['firstname'] = $row['Username'];
$posted['email'] = $row['Email'];
$posted['phone'] = $row['Mobile_No'];
$posted['productinfo'] = $payment_info;

//echo '<pre>';print_r($row);
$MERCHANT_KEY = "X30xbPqQ";
$SALT = "hWDqztfBes";
// Merchant Key and Salt as provided by Payu.

$PAYU_BASE_URL = "https://sandboxsecure.payu.in";		// For Sandbox Mode
//$PAYU_BASE_URL = "https://secure.payu.in";			// For Production Mode

$action = '';


if(!empty($_POST)) {
    //print_r($_POST);
  foreach($_POST as $key => $value) {    
    $posted[$key] = $value; 
	
  }
}

$formError = 0;

if(empty($posted['txnid'])) {
  // Generate random transaction id
  $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
} else {
  $txnid = $posted['txnid'];
}
$hash = '';
// Hash Sequence
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
if(empty($posted['hash']) && sizeof($posted) > 0) {
  if(
          empty($posted['key'])
          || empty($posted['txnid'])
          || empty($posted['amount'])
          || empty($posted['firstname'])
          || empty($posted['email'])
          || empty($posted['phone'])
          || empty($posted['productinfo'])
          || empty($posted['surl'])
          || empty($posted['furl'])
		  || empty($posted['service_provider'])
  ) {
    $formError = 1;
  } else {
    //$posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
	$hashVarsSeq = explode('|', $hashSequence);
    $hash_string = '';	
	foreach($hashVarsSeq as $hash_var) {
      $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
      $hash_string .= '|';
    }

    $hash_string .= $SALT;


    $hash = strtolower(hash('sha512', $hash_string));
    $action = $PAYU_BASE_URL . '/_payment';
  }
} elseif(!empty($posted['hash'])) {
  $hash = $posted['hash'];
  $action = $PAYU_BASE_URL . '/_payment';
}
$udf1 = $user_id;
$udf2 = $pack;
?>
<html>
  <head>
    <title>News Portal - Payment</title>
      <link rel="icon" type="image/gif/jpg" href="../images/logo-main.jpg">
      <link rel="stylesheet" type="text/css" href="../css/astyle.css" />
  <script>
    var hash = '<?php echo $hash ?>';
    function submitPayuForm() {
      if(hash == '') {
        return;
      }
      var payuForm = document.forms.payuForm;
      payuForm.submit();
    }
  </script>
  </head>
  <body onload="submitPayuForm()">
    <div id="page">
      <div id="content" class="container1">
        <section>       
                <div id="wrapper1">
                        <div id="login">
                            <form action="<?php echo $action; ?>" method="post" name="payuForm"> 
                                <h1 style="margin: 10px 0;">PayUForm</h1> 
    
    <br/>
    <?php if($formError) { ?>
	
      <!-- <span style="color:red">Please fill all mandatory fields.</span> -->
      <!-- <br/> -->
      <!-- <br/> -->
    <?php } ?>
    <form action="<?php echo $action; ?>" method="post" name="payuForm">
      <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
      <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
      <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
      <input type="hidden" name="udf1" value="<?php echo $udf1 ?>" />
      <input type="hidden" name="udf2" value="<?php echo $udf2 ?>" />
      <input type="hidden" name="surl" value="http://localhost:8083/External_Final_07_01/payment/success.php" size="64" />
      <input type="hidden" name="furl" value="http://localhost:8083/External_Final_07_01/payment/failure.php" size="64" />

      <table>
        <tr>
          <!-- <td align="center"><b>Mandatory Parameters</b></td> -->
        </tr>

        <tr>
          <td>Amount: </td>
          <td><input name="amount" readonly="" required value="<?php echo $price; ?>" /></td>
        </tr>

        <tr>
          <td>User Name: </td>
          <td><input name="firstname" required id="firstname" readonly="" value="<?php echo (empty($posted['firstname'])) ? '' : $posted['firstname']; ?>" /></td>
        </tr>

        
        <tr>
          <td>Email: </td>
          <td><input name="email" required id="email" readonly="" value="<?php echo (empty($posted['email'])) ? '' : $posted['email']; ?>" /></td>
        </tr>

        <tr>
          <td>Phone No.: </td>
          <td><input name="phone" readonly="" required value="<?php echo (empty($posted['phone'])) ? '' : $posted['phone']; ?>" /></td>
        </tr>

        <tr>
          <td>News Payment Info: </td>
          <td colspan="3"><textarea rows="3" required style="width: 290px;padding-left: 32px;" name="productinfo"><?php echo (empty($posted['productinfo'])) ? '' : $posted['productinfo'] ?></textarea></td>
        </tr>
       <!-- <tr>
           <td>Success URI: </td> 
          <td colspan="3"></td>
        </tr>
        <tr>
           <td>Failure URI: </td> 
          <td colspan="3"></td>
        </tr> -->

        <tr>
          <td colspan="3"><input type="hidden" name="service_provider" value="payu_paisa" size="64" /></td>
        </tr> 

        <!-- <tr>
          <td><b>Optional Parameters</b></td>
        </tr> -->
        <tr>
          <!-- <td>Last Name: </td> -->
          <td><input type="hidden" name="lastname" id="lastname" value="<?php echo (empty($posted['lastname'])) ? '' : $posted['lastname']; ?>" /></td>
          <!-- <td>Cancel URI: </td> -->
          <td><input type="hidden" name="curl" value="" /></td>
        </tr>
        <tr>
          <!-- <td>Address1: </td> -->
          <td><input type="hidden" name="address1" value="<?php echo (empty($posted['address1'])) ? '' : $posted['address1']; ?>" /></td>
          <!-- <td>Address2: </td> -->
          <td><input type="hidden" name="address2" value="<?php echo (empty($posted['address2'])) ? '' : $posted['address2']; ?>" /></td>
        </tr>
        <tr>
          <!-- <td>City: </td> -->
          <td><input type="hidden" name="city" value="<?php echo (empty($posted['city'])) ? '' : $posted['city']; ?>" /></td>
          <!-- <td>State: </td> -->
          <td><input type="hidden" name="state" value="<?php echo (empty($posted['state'])) ? '' : $posted['state']; ?>" /></td>
        </tr>
        <tr>
         <!--  <td>Country: </td> -->
          <td><input type="hidden" name="country" value="<?php echo (empty($posted['country'])) ? '' : $posted['country']; ?>" /></td>
          <!-- <td>Zipcode: </td> -->
          <td><input type="hidden" name="zipcode" value="<?php echo (empty($posted['zipcode'])) ? '' : $posted['zipcode']; ?>" /></td>
        </tr>
        <tr>
          <!-- <td>UDF1: </td> -->
          <td><input type="hidden" name="udf1" value="<?php echo (empty($posted['udf1'])) ? '' : $posted['udf1']; ?>" /></td>
         <!--  <td>UDF2: </td> -->
          <td><input type="hidden" name="udf2" value="<?php echo (empty($posted['udf2'])) ? '' : $posted['udf2']; ?>" /></td>
        </tr>
        <tr>
         <!--  <td>UDF3: </td> -->
          <td><input type="hidden" name="udf3" value="<?php echo (empty($posted['udf3'])) ? '' : $posted['udf3']; ?>" /></td>
          <!-- <td>UDF4: </td> -->
          <td><input type="hidden" name="udf4" value="<?php echo (empty($posted['udf4'])) ? '' : $posted['udf4']; ?>" /></td>
        </tr>
        <tr>
          <!-- <td>UDF5: </td> -->
          <td><input type="hidden" name="udf5" value="<?php echo (empty($posted['udf5'])) ? '' : $posted['udf5']; ?>" /></td>
          <!-- <td>PG: </td> -->
          <td><input type="hidden" name="pg" value="<?php echo (empty($posted['pg'])) ? '' : $posted['pg']; ?>" /></td>
        </tr>
        <tr>
          <?php if(!$hash) { ?>
            <td colspan="4" align="center"><p  class="login button"><input type="submit" value="Submit" /></td>
          <?php } ?>
        </tr>
      </table>
    </form>
  </body>
</html>
