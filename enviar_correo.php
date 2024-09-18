<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Asegúrate de que esta ruta es correcta según tu instalación de PHPMailer

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars($_POST['nombre']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $mensaje = htmlspecialchars($_POST['mensaje']);

    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP de Hostinger
        $mail->isSMTP();
        $mail->Host = 'smtp.hostinger.com'; // Servidor SMTP de Hostinger
        $mail->SMTPAuth = true;
        $mail->Username = 'cerca@oscarsoft.me'; // Reemplaza con tu dirección de correo de Hostinger
        $mail->Password = 'Gaylord4431?'; // Reemplaza con la contraseña de tu correo de Hostinger
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Usa SSL
        $mail->Port = 465; // Puerto SMTP para SSL

        // Configuración del correo
        $mail->setFrom('cerca@oscarsoft.me', 'Oscarsoft'); // Remitente del correo
        $mail->addAddress('cerca@oscarsoft.me'); // Destinatario (puede ser el mismo o diferente)

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = 'Consulta desde el formulario de contacto';
        $mail->Body    = "Nombre: $nombre<br>Correo: $email<br><br>Mensaje:<br>$mensaje";
        $mail->AltBody = "Nombre: $nombre\nCorreo: $email\n\nMensaje:\n$mensaje"; // Texto sin formato

        // Enviar el correo
        $mail->send();
        echo "<p>Gracias por tu mensaje. Nos pondremos en contacto contigo pronto. Te estamos redirigiendo al Home...</p>";
        echo '<script>
                setTimeout(function() {
                    window.location.href = "http://localhost/desarrollo/index.html";
                }, 3000);
              </script>';
    } catch (Exception $e) {
        echo "Hubo un error al enviar el correo: {$mail->ErrorInfo}";
    }
}
?>
