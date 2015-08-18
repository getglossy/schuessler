<?php 
include 'common.php';
$reservationsList = urldecode($_POST["custom"]);
$orderResult = 0;

// Build the required acknowledgement message out of the notification just received
  $req = 'cmd=_notify-validate';               // Add 'cmd=_notify-validate' to beginning of the acknowledgement

  foreach ($_POST as $key => $value) {         // Loop through the notification NV pairs
    $value = urlencode(stripslashes($value));  // Encode these values
    $req  .= "&$key=$value";                   // Add the NV pairs to the acknowledgement
  }
  
   // Set up the acknowledgement request headers
  $header  = "POST /cgi-bin/webscr HTTP/1.1\r\n";                    // HTTP POST request
  $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
  $header .= "Host: www.paypal.com\r\n";
  $header .= "Content-Length: " . strlen($req) . "\r\n\r\n";

  // Open a socket for the acknowledgement request
  $fp = fsockopen('ssl://www.paypal.com', 443, $errno, $errstr, 30);

  // Send the HTTP POST request back to PayPal for validation
  fputs($fp, $header . $req);
  
   while (!feof($fp)) {                     // While not EOF
    $res = fgets($fp, 1024);   
	
	
	              // Get the acknowledgement response
    if (strcmp (trim($res), "VERIFIED") == 0) {  // Response contains VERIFIED - process notification
		$orderResult = 1;
		$bookingReservationObj->confirmReservations($reservationsList);
      // Send an email announcing the IPN message is VERIFIED
      /*$mail_From    = "IPN@example.com";
      $mail_To      = "d.romeo@wachipi.com";
      $mail_Subject = "VERIFIED IPN";
      $mail_Body    = $req."-".$reservationsList;
      mail($mail_To, $mail_Subject, $mail_Body, $mail_From);*/



      // Authentication protocol is complete - OK to process notification contents

      // Possible processing steps for a payment include the following:

      // Check that the payment_status is Completed
      // Check that txn_id has not been previously processed
      // Check that receiver_email is your Primary PayPal email
      // Check that payment_amount/payment_currency are correct
      // Process payment

    } 
    else if (strcmp (trim($res), "INVALID") == 0) { 
		$orderResult = 0;
		$bookingReservationObj->deleteReservations($reservationsList);
	//Response contains INVALID - reject notification

      // Authentication protocol is complete - begin error handling

      // Send an email announcing the IPN message is INVALID
      /*$mail_From    = "IPN@example.com";
      $mail_To      = "d.romeo@wachipi.com";
      $mail_Subject = "INVALID IPN";
      $mail_Body    = $req."-".$reservationsList;

      mail($mail_To, $mail_Subject, $mail_Body, $mail_From);*/
    }
  }
 

  
   fclose($fp);  // Close the file


/*if($orderResult == 1) {
	
	 //confirm reservation
	 $bookingReservationObj->confirmReservations($reservationsList);
	 $mail_From    = "IPN@example.com";
      $mail_To      = "d.romeo@wachipi.com";
      $mail_Subject = "IPN";
      $mail_Body    = "order result 1".mysql_error();

      mail($mail_To, $mail_Subject, $mail_Body, $mail_From);
 } else {
	 //if payment failed delete reservation to free slot
	 $bookingReservationObj->deleteReservations($reservationsList);
	 $mail_From    = "IPN@example.com";
      $mail_To      = "d.romeo@wachipi.com";
      $mail_Subject = "IPN";
      $mail_Body    = "order result 0".mysql_error();

      mail($mail_To, $mail_Subject, $mail_Body, $mail_From);
 }*/


?>