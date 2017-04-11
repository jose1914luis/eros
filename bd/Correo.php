<?php

$upOne = realpath(__DIR__ . '/..');
include $upOne . '/PHPMailer/PHPMailerAutoload.php';

class Correo {

    public $mail;
    private $foot = '';

    public function __construct() {

        $this->mail = new PHPMailer();
        $this->mail->Host = 'paginaerotica.com';
        $this->mail->Username = 'no_responder@paginaerotica.com';
        $this->mail->Port = 25;

        $this->mail->setFrom('no_responder@paginaerotica.com', 'Pagina Erotica');

        $this->mail->addBCC('jose1914luis@gmail.com', 'Jose Luis');
        $this->mail->addBCC('admin@paginaerotica.com', 'Pagina Erotica');
        $this->mail->isHTML(true);

        $this->foot = '
<p>Si tienes algún inconveniente, ponte en contacto con nosotros al correo:  <a href="mailto:admin@paginaerotica.com?Subject=Hola">admin@paginaerotica.com</a></p>
<p><br>--<br>
    <a href="http://www.paginaerotica.com/">www.paginaerotica.com</a><br>
    ¡Ven y Encuentra tu placer preferido!</p>
<img src="http://www.paginaerotica.com/pag_ima/pagina4.png" alt="www.paginaerotica.com"/>
<p>Síguenos en nuestras redes sociales:<br>
    <a href="https://www.facebook.com/paginaerotica/"><img src="http://www.paginaerotica.com/pag_ima/facebook-icon.png" alt="Facebook"/></a>
    <a href="https://plus.google.com/u/0/108391897041123069024"><img src="http://www.paginaerotica.com/pag_ima/Web-Google-plus-alt-Metro-icon.png" alt="Google+"/></a>
    <a href="https://www.instagram.com/paginaerotica/"><img src="http://www.paginaerotica.com/pag_ima/Active-Instagram-1-icon.png" alt="Instagram"/></a>
</p>
<p style="text-align: justify; font-size: 11px">
    Este mensaje va dirigido, de manera exclusiva, a su destinatario y puede contener información confidencial y sujeta al secreto profesional, cuya divulgación no está permitida por la ley. En caso de haber recibido este mensaje por error, le rogamos que, de forma inmediata, nos lo comunique mediante correo electrónico remitido a nuestra atención y proceda a su eliminación, así como a la de cualquier documento adjunto al mismo. Asimismo, le comunicamos que la distribución, copia o utilización de este mensaje, o de cualquier documento adjunto al mismo, cualquiera que fuera su finalidad, están prohibidas por la ley. En aras del cumplimiento de la LOPD y el RDLOP, puede ejercer los derechos A.R.C.O. de manera gratuita mediante email admin@paginaerotica.com o en la direccion Cl. 7 Sur #42-70 oficina 1101, Medellín, Antioquia.
</p>';
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
<p>Muchas graciar por usar <a href="http://www.paginaerotica.com/">paginaerotica.com</a> para nosotros en un placer brindarte nuestro servicio.</p><br>';


        $this->mail->Body = $body . $this->foot;
        $this->mail->addAddress($email, 'Usuario');
    }

    public function pago($email, $idanuncio, $url) {

        $this->mail->Subject = 'Anuncio Publicado';


        $body = '<H1>Hola, Como estas!!</H1>
<p><b>Gracias por publicar en <a href="http://www.paginaerotica.com/">www.paginaerotica.com</a>.</b> Para nosotros es un placer prestarte nuestros servicios. Estos son los detalles de tu anuncio:</p>
<p>    
    <b>ID ANUNCIO:</b>' . $idanuncio . '<br>
    <b>URL:</b> <a href="http://www.paginaerotica.com/P_AN/' . $idanuncio . '/' . $url . '">http://www.paginaerotica.com/P_AN/195/Escorts/Antioquia/</a><br>
    <b>TIPO ANUNCIO:</b> Básico por 30 días con 5 re-publicaciones.</p>
<p>Publicar en paginaerotica.com no tiene costo alguno, sin embargo puedes hacer que tu anuncio sea más visible y obtener múltiples beneficios:
<ol>
    <li>Aumenta la visión de tu publicidad.</li>    
    <li>Aumenta el número de clientes potenciales.</li>    
    <li>Tu anuncio permanecerá con nosotros 3 meses.</li>    
    <li>Re-publicaciones ilimitadas.</li>    
</ol>
<p>El costo de actualizar tu anuncio es de $10.000 COP.</p>
<b style="color: red">FORMAS DE PAGO</b>
<p>Tienes 3 posibilidades de pago, las tres vinculadas a nuestro  responsable de cobros en Colombia, JOSÉ LUIS GARCÍA HERNÁNDEZ.</p>
<b style="color: #4c87ff"><ins>POR INGRESO EN VENTANILLA O TRANSFERENCIA DE OTRO BANCO QUE NO SEA BANCOLOMBIA</ins></b>
<br>
<br>
<table>
    <tr>
        <th>BANCO:</th>   
        <td>BANCOLOMBIA</td>
    </tr>
    <tr>
        <th>BENEFICIARIO:</th>
        <td>JOSÉ LUIS GARCÍA HERNÁNDEZ</td>
    </tr>
    <tr>
        <th>Nº DE CUENTA:</th>
        <td>31057830151</td>
    </tr>
    <tr>
        <th>IMPORTE NETO:</th>
        <td>$10.000 Netos  + el valor que cobre la entidad financiera por realizar la transferencia</td>
    </tr>
</table>
<br>
<b style="color: #4c87ff"><ins>POR TRANSFERENCIA BANCOLOMBIA</ins></b>
<br>
<br>
<table>
    <tr>
        <th>BANCO:</th>   
        <td>BANCOLOMBIA</td>
    </tr>
    <tr>
        <th>BENEFICIARIO:</th>
        <td>JOSÉ LUIS GARCÍA HERNÁNDEZ</td>
    </tr>
    <tr>
        <th>Nº DE CUENTA:</th>
        <td>31057830151</td>
    </tr>
    <tr>
        <th>IMPORTE NETO:</th>
        <td>$10.000 Netos  + el valor que cobre la entidad financiera por realizar la transferencia</td>
    </tr>
</table>
<br>
<b style="color: #4c87ff"><ins>GIRO POR EFECTY - BALOTO - GANA - SUPERGIROS</ins></b>
<br>
<br>
<table>    
    <tr>
        <th>DESTINATARIO:</th>
        <td>JOSÉ LUIS GARCÍA HERNÁNDEZ</td>
    </tr>
    <tr>
        <th>CÉDULA:</th>
        <td>1035421260</td>
    </tr>
    <tr>
        <th>CIUDAD:</th>   
        <td>Medellín</td>
    </tr>
    <tr>
        <th>IMPORTE NETO:</th>
        <td>$10.000 Netos  + el valor que cobre la entidad financiera por realizar la transferencia</td>
    </tr>
</table>
<p><b style="color: red">Muy importante!</b> <b>una vez haya hecho el pago responda a este email (<a href="mailto:admin@paginaerotica.com?Subject=Hola">admin@paginaerotica.com</a>)  o via WhatsApp 3197614377 con el recibo de consignación escaneado y el ID del anuncio. </b></p>
<p>Muchas graciar por usar <a href="http://www.paginaerotica.com/">paginaerotica.com</a> para nosotros en un placer brindarte nuestro servicio</p>
';
        $this->mail->Body = $body . $this->foot;
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
