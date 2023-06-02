<?php
//Autor : Jean Pier Carrasco Tamariz
namespace Controllers;
//Llamamos a la libreria PHPMailer
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
//Creamos la clase
class Correo{
    //Definimos la funcion de configuracion
    public function hostCorreoConfiguracion()
    {
        //Llamos a phpMailer
        $mail = new PHPMailer(true);
        try {
            //Decimos que el protocolo es SMTP
            $mail->isSMTP();
            //Deshabilitamos el debug
            $mail->SMTPDebug = 0;
            // Colocamos el host de gmail
            $mail->Host = 'smtp.gmail.com';
            //Habilitamos la autenticacion con gmail
            $mail->SMTPAuth = true;
            // Colocamos el correo del cual sera enviado
            $mail->Username = 'jeanpi.jpct@gmail.com';
            // colocamos la contraseña el cual es una encriptada
            $mail->Password = 'yhtmokobrranuecc';
            // Encriptamos la contraseña 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            //Definimos el puero
            $mail->Port = 465;

            //Enviamos desde el correo asignado
            $mail->setFrom('jeanpi.jpct@gmail.com', 'BODEGAFAST');
            //Retornamos el mail
            return $mail;
        } catch (Exception $e) {
            return ['error' => $mail->ErrorInfo];
        }
    }
    public function enviarCorreoCompra(string $asunto,string $correoEnvio,string $nombreCorreo, string $body, string $bodyShort)
    {
        //Obtenemos el mail
        $mail = $this->hostCorreoConfiguracion();
        //Añadimos nuestro logo
        $mail->addAttachment($_SERVER['DOCUMENT_ROOT'].'/Public/img/logo.png', 'bodegafast.jpg');
        //añadimos el correo a enviar
        $mail->addAddress($correoEnvio, $nombreCorreo);
        //Habilitamos el html
        $mail->isHTML(true);
        //Añadimos el asusnto
        $mail->Subject = $asunto;
        //Definimos UTF8 Para no tener problemas con caracteres especiales
        $mail->CharSet = "UTF-8";
        //Añadimos el cuerpo
        $mail->Body    = $body;
        //Añadimos el pequeño cuerpo
        $mail->AltBody = $bodyShort;
        //Enviamos el correo
        $mail->send();
        return ['success' => 'Correo enviado correctamente'];
    }
}
