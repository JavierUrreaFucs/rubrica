<?php
require_once("../db/conexionRubrica.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once('../vendor/autoload.php');

class correoManager
{

  private $con;

  public function __construct()
  {
    $this->con = new ConexionRubrica();
  }

  public function correoUsuario($correo)
  {
    $mail = new PHPMailer(true);

    try {
      // Configuración del servidor SMTP
      $mail->isSMTP();
      $mail->Host       = 'smtp.gmail.com';  // Servidor SMTP
      $mail->SMTPAuth   = true;
      $mail->Username   = 'legalizacion.matricula@fucsalud.edu.co';  // Usuario SMTP
      $mail->Password   = 'insb bnde slru bfyh';  // Contraseña SMTP
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  // Habilitar encriptación TLS
      $mail->Port       = 587;  // Puerto TCP

      // Remitente y destinatarios
      $mail->setFrom('legalizacion.matricula@fucsalud.edu.co');
      $mail->addAddress($correo);  // Añadir destinatario

      // Contenido del correo
      $mail->isHTML(true);
      $mail->Subject = 'Rubrica de calificaciones - Nuevo usuario asignado';
      $mail->Body    = 'Bienvenido al aplicativo de <b>Rubrica de Entrevistas</b>.<br><br>
      Las credenciales de acceso al aplicativo son los siguientes:<br><br>
      <b>Usuario:</b> '.$correo.'<br>
      <b>Contraseña:</b> fucsalud123*<br><br>
      Una vez ingrese al aplicativo se recomienda cambiar la contraseña.<br><br>
      Cordialmente,<br><br>
      <b>Admisiones, registro y control</b>';

      // Enviar correo
      $mail->send();

    } catch (Exception $e) {
      echo "Error al enviar el correo: {$mail->ErrorInfo}";
    }
  }

  //Funcion para recuperar contraseña
  public function recuperacionpass($numero, $correo1)
  {

    $mail = new PHPMailer(true);
    try {
      $mail->SMTPDebug = 0; // Habilita la salida de depuración detallada 
      $mail->isSMTP(); // Configure el remitente para usar SMTP 
      $mail->Host = 'smtp.gmail.com'; //Especifique los servidores SMTP principales y de respaldo 
      $mail->SMTPAuth = true; // Enable SMTP authentication
      $mail->Username = 'legalizacion.matricula@fucsalud.edu.co'; // SMTP username
      $mail->Password = 'insb bnde slru bfyh'; // Habilitar autenticación SMTP    
      $mail->SMTPSecure = 'tls'; // Habilita el cifrado TLS, `ssl` también aceptó 
      $mail->Port = 587; // puerto TCP para conectarse        
      $mail->setFrom('legalizacion.matricula@fucsalud.edu.co');
      $mail->addAddress($correo1); 
      $mail->isHTML(true); // Establezca el formato de correo electrónico en HTML
      $mail->CharSet = 'UTF-8';
      $mail->Subject = 'Recuperación contraseña';
      $body = "Cordial Saludo,<br><br>Usted solicitó un restablecimiento de contraseña a través del aplicativo de Rubrica de Entrevistas.<br><br>Hemos proporcionado su nueva contraseña temporal, que podrá utilizar para iniciar sesión en el aplicativo. Una vez que haya iniciado sesión, asegúrese de cambiar esta contraseña temporal por una nueva.<br><br>Nueva contraseña temporal: <strong>" . $numero . "<br><br>Recuerde que es esencial mantener su contraseña segura y no compartirla con nadie.<br><br><strong>No responda a este correo.</strong>";
      $mail->Body = $body;
      $mail->send();
    } catch (Exception $e) {
      echo " No se pudo enviar el mensaje. Error de envío: " . $mail->ErrorInfo;
    }
  }
}
