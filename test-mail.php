<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 03-02-2019
 * Time: 20:00
 */

$to = "someone@somone.com";
$subject="Test Mail";

$message = "<b>This is Message</b>";
$message .="<b>This is Message</b>";

$header = "From:kirtimotwani303@gmail.com\r\n";
$header .= "CC:shahvrushali22@gmail.com\r\n";
$header .= "MIME-version: 1.0\r\n";
$header .= "Content-Type: text/html\r\n";

if(mail($to, $subject, $message, $header)){
    echo "sent";
}else{
    echo "failed";
}
