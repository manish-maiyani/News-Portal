<?php
 
/** RefundTransaction NVP example; last modified 08MAY23.
 *
 *  Issue a refund for a prior transaction.
*/
 
$environment = 'sandbox';   // or 'beta-sandbox' or 'live'
 
/**
 * Send HTTP POST Request
 *
 * @param   string  The API method name
 * @param   string  The POST Message fields in &name=value pair format
 * @return  array   Parsed HTTP Response body
 */
function PPHttpPost($methodName_, $nvpStr_) {
    global $environment;
 
    // Set up your API credentials, PayPal end point, and API version.
    $API_UserName = urlencode('maiyanimanishd1_api1.gmail.com');
    $API_Password = urlencode('JRVC5H6KTZPCERDG');
    $API_Signature = urlencode('Ai7QAFsEZFrzMq9uFUtZsxo9k01SARq4odxcEXThqMHSUGvQqYbfhNZb');
    $API_Endpoint = "https://api-3t.paypal.com/nvp";
    if("sandbox" === $environment || "beta-sandbox" === $environment) {
    $API_Endpoint = "https://api-3t.$environment.paypal.com/nvp";
    }
    $version = urlencode('51.0');
 
    // Set the curl parameters.
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $API_Endpoint);
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
 
    // Turn off the server and peer verification (TrustManager Concept).
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
 
    // Set the API operation, version, and API signature in the request.
    $nvpreq = "METHOD=$methodName_&VERSION=$version&PWD=$API_Password&USER=$API_UserName&SIGNATURE=$API_Signature$nvpStr_";
 
    // Set the request as a POST FIELD for curl.
    curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);
 
    // Get response from the server.
    $httpResponse = curl_exec($ch);
 
    if(!$httpResponse) {
        exit("$methodName_ failed: ".curl_error($ch).'('.curl_errno($ch).')');
    }
 
    // Extract the response details.
    $httpResponseAr = explode("&", $httpResponse);
 
    $httpParsedResponseAr = array();
    foreach ($httpResponseAr as $i => $value) {
        $tmpAr = explode("=", $value);
        if(sizeof($tmpAr) > 1) {
            $httpParsedResponseAr[$tmpAr[0]] = $tmpAr[1];
        }
    }
 
    if((0 == sizeof($httpParsedResponseAr)) || !array_key_exists('ACK', $httpParsedResponseAr)) {
        exit("Invalid HTTP Response for POST request($nvpreq) to $API_Endpoint.");
    }
 
    return $httpParsedResponseAr;
}
$mysqli = mysqli_connect("localhost", "id6971136_root", "HKschool6638@@", "id6971136_project");
$cat = mysqli_query($mysqli,"SELECT * FROM paypal WHERE ID='".$_GET['id']."'");
while($row = mysqli_fetch_assoc($cat))
    {

// Set request-specific fields.
$transactionID = urlencode($row['Tran_ID']); }
$refundType = urlencode('Full');                        // or 'Partial'
$amount;                                                // required if Partial.
$memo;                                                  // required if Partial.
$currencyID = urlencode('USD');                         // or other currency ('GBP', 'EUR', 'JPY', 'CAD', 'AUD')
 
// Add request-specific fields to the request string.
$nvpStr = "&TRANSACTIONID=$transactionID&REFUNDTYPE=$refundType&CURRENCYCODE=$currencyID";
 
if(isset($memo)) {
    $nvpStr .= "&NOTE=$memo";
}
 
if(strcasecmp($refundType, 'Partial') == 0) {
    if(!isset($amount)) {
        exit('Partial Refund Amount is not specified.');
    } else {
        $nvpStr = $nvpStr."&AMT=$amount";
    }
 
    if(!isset($memo)) {
        exit('Partial Refund Memo is not specified.');
    }
}
 
// Execute the API operation; see the PPHttpPost function above.
$httpParsedResponseAr = PPHttpPost('RefundTransaction', $nvpStr);
 
if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) {
  
  $mysqli = mysqli_connect("localhost", "id6971136_root", "HKschool6638@@", "id6971136_project");
  mysqli_query($mysqli, "DELETE FROM paypal WHERE id='".$_GET['id']."'");
    echo "<script type='text/javascript'> document.location.href='refund.php'; alert('You have successfully refunded!!'); </script>";
} else  {
    exit('RefundTransaction failed: ' . print_r($httpParsedResponseAr, true));
}
 
?>


