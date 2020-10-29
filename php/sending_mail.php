<?php
session_start();

//removed attactment file feature 

//vars
$message = $_POST['message'];
$from = $_POST['email'];
$subject = $_POST['subject'];
$mailto = 'syncroeditz@gmail.com';


// use wordwrap() if lines are longer than 70 characters
$nmessage = wordwrap($message,70);
$header = 'Reply-To: '.$from . "\r\n";

	
$ress = array('error' => NULL, 'msg' => NULL); 	
// check captcha first;
if (isset($_SESSION['simpleCaptchaAnswer']) && $_POST['captchaSelection'] == $_SESSION['simpleCaptchaAnswer']) {
  //SEND Mail 
   if(mail($mailto,$subject,$nmessage, $header)){
    $ress['msg'] = "Thanks, I will get back to you ASAP";
  } else {
    $ress['error'] = "error : email not sent";
  }
} else {
  $ress['error'] = "Please check your answer!";
}

//respond to json 
echo json_encode($ress);
?>