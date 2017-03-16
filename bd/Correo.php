<?php

require './PHPMailer/PHPMailerAutoload.php';
require_once 'Anuncio.php';
require_once 'Usuario.php';

function crear() {

    $mail = new PHPMailer;
    $mail->Host = 'paginaerotica.com';
    $mail->Username = 'no_responder@paginaerotica.com';
    $mail->Port = 25;

    $mail->setFrom('no_responder@paginaerotica.com', 'Pagina Erotica');

    $mail->addBCC('jose1914luis@gmail.com');
    $mail->isHTML(true);
    
    return $mail;
}

function bienvenida($email, $contra, $mail) {

    $mail->Subject = 'Cuenta de Usuario';
    $mail->Body = '<h2>Bienvenido,</h2>
        <p>Gracias por publicar en <a href="paginaerotica.com">paginaerotica.com</a></p>
        <p>Se ha creado una cuenta temporal en la que puedes administrar tu anuncio, promoverlo, editarlo o borrarlo, pulsa el link a continuación he ingresa con los datos de acceso:</p>
        <p><b>Email:</b> ' . $email . '</p>
        <p><b>Contraseña:</b> ' . $contra . '</p>
        <p><b>Ingresa estos datos en el siguiente link: </b><p>
        <p><b>link:</b> <a href="paginaerotica.com/session">paginaerotica.com/session</a></p><br>
        <p>Muchas graciar por usar <a href="paginaerotica.com">paginaerotica.com</a> para nosotros en un placer brindarte nuestro servicio.</p><br><br>
        <p>Si tienes algún inconveniente ponte en contacto con nosotros:</p>
        <p>Contacto: <a href="administracion@paginaerotica.com">administracion@paginaerotica.com</a></p>';
}

function validar_bienvenida($email) {    
    
    $anuncio = new Anuncio();
    $usuario = new Usuario();

    $total = $anuncio->total_email($email);

    if ($total == 1) {

        $mail = crear();
        $datos = $usuario->getUsuariobyEmail($email);
        bienvenida($datos['email'], $datos['contra'], $mail);
        $mail->addAddress($datos['email'], 'Usuario');
        enviar($mail);
    }
}

function enviar($mail) {
    if (!$mail->send()) {
        //$mail->ErrorInfo;
        return false;
    } else {
        return true;
    }
}
