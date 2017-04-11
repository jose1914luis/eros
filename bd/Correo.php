<?php

include '../PHPMailer/PHPMailerAutoload.php';

class Correo {

    public $mail;

    public function __construct() {

        $this->mail = new PHPMailer();
        $this->mail->Host = 'paginaerotica.com';
        $this->mail->Username = 'no_responder@paginaerotica.com';
        $this->mail->Port = 25;

        $this->mail->setFrom('no_responder@paginaerotica.com', 'Pagina Erotica');

        $this->mail->addBCC('jose1914luis@gmail.com');
        $this->mail->isHTML(true);
    }

    public function bienvenida($email, $contra) {

        $this->mail->Subject = 'Cuenta de Usuario';


        $body = '<h2>Bienvenido,</h2>
<p>Gracias por publicar en <a href="http://www.paginaerotica.com/">www.paginaerotica.com.</a></p>
<p>Se ha creado una cuenta en la que puedes administrar tu anuncio, promoverlo, editarlo o borrarlo, pulsa el link a continuación he ingresa con los datos de acceso:</p>
<p><b>Email:</b> ' . $email . '</p>
<p><b>Contraseña:</b> ' . $contra . '</p>
<p><b>Ingresa estos datos en el siguiente link: </b><p>
<p><b>link:</b> <a href=http://www.paginaerotica.com/session">www.paginaerotica.com/session</a></p><br>
<p>Muchas graciar por usar <a href="http://www.paginaerotica.com/">paginaerotica.com</a> para nosotros en un placer brindarte nuestro servicio.</p><br>
<p>Si tienes algún inconveniente, ponte en contacto con nosotros al correo:  <a href="mailto:administracion@paginaerotica.com?Subject=Hola">admin@paginaerotica.com</a></p>';
        $foot = '<p><br>--<br>
    <a href="http://www.paginaerotica.com/">www.paginaerotica.com</a><br>
    ¡Ven y Encuentra tu placer preferido!</p>
<img src="http://www.paginaerotica.com/pag_ima/pagina4.png" alt="www.paginaerotica.com"/>
<p>Síguenos en nuestras redes sociales:<br>
    <a href="https://www.facebook.com/paginaerotica/"><img src="http://www.paginaerotica.com/pag_ima/facebook-icon.png" alt="Facebook"/></a>
    <a href="https://plus.google.com/u/0/108391897041123069024"><img src="http://www.paginaerotica.com/pag_ima/Web-Google-plus-alt-Metro-icon.png" alt="Google+"/></a>
    <a href="https://www.instagram.com/paginaerotica/"><img src="http://www.paginaerotica.com/pag_ima/Active-Instagram-1-icon.png" alt="Instagram"/></a>
</p>
<p style="text-align: justify; font-size: 11px">
    Este mensaje va dirigido, de manera exclusiva, a su destinatario y puede contener información confidencial y sujeta al secreto profesional, cuya divulgación no está permitida por la ley. En caso de haber recibido este mensaje por error, le rogamos que, de forma inmediata, nos lo comunique mediante correo electrónico remitido a nuestra atención y proceda a su eliminación, así como a la de cualquier documento adjunto al mismo. Asimismo, le comunicamos que la distribución, copia o utilización de este mensaje, o de cualquier documento adjunto al mismo, cualquiera que fuera su finalidad, están prohibidas por la ley. En aras del cumplimiento de la LOPD y el RDLOP, puede ejercer los derechos A.R.C.O. de manera gratuita mediante email no_reponder@paginaerotica.com o en la direccion Cl. 7 Sur #42-70, Medellín, Antioquia.
</p>';


        $this->mail->Body = $body . $foot;
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
