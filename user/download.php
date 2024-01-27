<?php
    require('phpToPDF.php');
	$url = $_GET['href'];
if(substr($url, 0, 7) == "http://" || substr($url, 0, 8) == "https://"){

}else{
  $id = $_GET['id'];
  $url="http://localhost/External_Final_07_01/user/".$url."?id=".$id;
}
//echo $url;die;
    //Set Your Options -- see documentation for all options
    $pdf_options = array(
          "source_type" => 'url',
          "source" => $url,
          "action" => 'download',
      	  "footer" => "Page phptopdf_on_page_number of phptopdf_pages_total");

    //Code to generate PDF file from options above
    phptopdf($pdf_options);
	header("location:home.php");
?>
