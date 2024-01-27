<?php

    /*require_once(dirname(__FILE__) . '/vendor/autoload.php'); // require paypal files
    require_once(dirname(__FILE__) . '/vendor/paypal/rest-api-sdk-php/sample/bootstrap.php'); // require paypal files
    require_once(dirname(__FILE__) . '/vendor/paypal/rest-api-sdk-php/sample/common.php'); // require paypal files*/

    // call required PayPal functionality
  /*  use PayPal\Api\Address;
    use PayPal\Api\Amount;
    use PayPal\Api\Details;
    use PayPal\Api\ExecutePayment;
    use PayPal\Api\FundingInstrument;
    use PayPal\Api\Item;
    use PayPal\Api\ItemList;
    use PayPal\Api\Payer;
    use PayPal\Api\Payment;
    use PayPal\Api\PaymentCard;
    use PayPal\Api\PaymentExecution;
    use PayPal\Api\Transaction;
    use PayPal\Api\Capture;
    use PayPal\Api\Refund;
    use PayPal\Api\RefundRequest;
    use PayPal\Api\Sale;*/

    $mysqli = mysqli_connect("localhost", "root", "", "demo");
$cat = mysqli_query($mysqli,"SELECT * FROM paypal WHERE ID=".$_GET['id']."");
while($row = mysqli_fetch_assoc($cat))
    {

        $refNumber = $row['Tran_ID']; // PayPal transaction ID 
        $FinalTotal = $row['Amount']; // order total

        // get PayPal access token via cURL
        $ch = curl_init();
        $clientId = 'AQlag5RY-WW-kdvYnmUoMFloSlJahkgl4RMnF1I6fXCidGidkLjtEOQex1h5cZlwoRlOda-PdqxKAfKW';
        $secret = 'EFmoph3iBY2zHHB5u43_gZ09dOFy-HrG0vcdhLXAzHXQy6ZscA4ltlCJ01ZuCBIuFzL2bFEwSZAhnF-N';

        curl_setopt($ch, CURLOPT_URL, "https://api.sandbox.paypal.com/v1/oauth2/token");
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSLVERSION , 6); //NEW ADDITION
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($ch, CURLOPT_USERPWD, $clientId.":".$secret);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");

        $result = curl_exec($ch);
        $json = json_decode($result);
        $token = $json->access_token; // this is our PayPal access token

        // refund PayPal sale via cURL
        $header = Array(
            "Content-Type: application/json",
            "Authorization: Bearer $token",
        );
        
        $ch = curl_init("https://api.sandbox.paypal.com/v1/payments/sale/$refNumber/refund");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, '{}');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        $res = json_decode(curl_exec($ch));
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
      
        // if res has a state, retrieve it
        if(isset($res->state)){
            $state = $res->state;
        }else{
            $state = NULL; // otherwise, set to NULL
        }

        // if we have a state in the response...
        if($state == 'completed'){
            // the refund was successful
            $mysqli = mysqli_connect("localhost", "root", "", "demo");
    mysqli_query($mysqli, "DELETE FROM paypal WHERE id='".$_GET['id']."'");
    echo "<script type='text/javascript'> document.location.href='refund.php'; alert('You have successfully refunded!!'); </script>";
        }else{
            // the refund failed
            $errorName = $res->name; // ex. 'Transaction Refused.'
            $errorReason = $res->message; // ex. 'The requested transaction has already been fully refunded.'
        }
    }
?>