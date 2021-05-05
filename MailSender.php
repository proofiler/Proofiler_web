<?php     
$to_email = 'rasp@localhost';
$subject = 'Testing PHP Mail';
$message = 'This mail is sent using the PHP mail function';
$headers = 'From: root@localhost';

mail($to_email,$subject,$message,$headers);
