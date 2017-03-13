<?php

error_reporting(-1);
ini_set('display_errors', 'On');

require './PHPMailer/PHPMailerAutoload.php';

class Correo {

    private $mail;

    function __construct($correo) {
        
        $this->mail = new PHPMailer;

        $this->$mail->Host = 'paginaerotica.com';  // Specify main and backup SMTP servers
//$mail->SMTPAuth = true;                               // Enable SMTP authentication
        $this->$mail->Username = 'no_responder@paginaerotica.com';                 // SMTP username
//$mail->Password = 'secret';                           // SMTP password
//$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $this->$mail->Port = 25;                                    // TCP port to connect to

        $this->$mail->setFrom('no_responder@paginaerotica.com', 'Pagina Erotica');
        $this->$mail->addAddress($correo, 'Nombre');     // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
        $mail->addReplyTo('jose1914luis@gmail.com', 'Registro');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');
//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = 'Bienvenido';
        $mail->Body = 'This is the HTML message body <b>in bold!</b>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        if (!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message has been sent';
        }
    }

}
