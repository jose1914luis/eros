<?php

include_once './PHPMailer/PHPMailerAutoload.php';

class Correo {

    public $mail;

    public function __construct() {

        $this->mail = new PHPMailer;
        $this->mail->Host = 'paginaerotica.com';
        $this->mail->Username = 'no_responder@paginaerotica.com';
        $this->mail->Port = 25;

        $this->mail->setFrom('no_responder@paginaerotica.com', 'Pagina Erotica');

        $this->mail->addBCC('jose1914luis@gmail.com');
        $this->mail->isHTML(true);
    }

    public function bienvenida($email, $contra) {

        $this->mail->Subject = 'Cuenta de Usuario';
        $this->mail->Body = '<h2>Bienvenido,</h2>
        <p>Gracias por publicar en <a href="paginaerotica.com">paginaerotica.com</a></p>
        <p>Se ha creado una cuenta temporal en la que puedes administrar tu anuncio, promoverlo, editarlo o borrarlo, pulsa el link a continuación he ingresa con los datos de acceso:</p>
        <p><b>Email:</b> ' . $email . '</p>
        <p><b>Contraseña:</b> ' . $contra . '</p>
        <p><b>Ingresa estos datos en el siguiente link: </b><p>
        <p><b>link:</b> <a href="paginaerotica.com/session">paginaerotica.com/session</a></p><br>
        <p>Muchas graciar por usar <a href="paginaerotica.com">paginaerotica.com</a> para nosotros en un placer brindarte nuestro servicio.</p><br><br>
        <p>Si tienes algún inconveniente ponte en contacto con nosotros:</p>
        <p>Contacto: <a href="administracion@paginaerotica.com">administracion@paginaerotica.com</a></p>';
        $this->mail->addAddress($email, 'Usuario');
    }    

    public function enviar() {
        if (!$this->mail->send()) {
            //$this->mail->ErrorInfo;
            return false;
        } else {
            return true;
        }
    }

}
