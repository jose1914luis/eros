<?php
$to      = 'jose1914luis@gmail.com';
$subject = 'the subject';
$message = 'hello';
$headers = 'From: no-responder@paginaerotica.com' . "\r\n" .
    'Reply-To: webmaster@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
?> 