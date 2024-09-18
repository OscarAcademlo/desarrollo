<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars($_POST['nombre']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $mensaje = htmlspecialchars($_POST['mensaje']);

    // Configuración del correo
    $para = 'cerca@oscarsoft.me';
    $titulo = 'Consulta desde el formulario de contacto';
    $mensaje_correo = "Nombre: $nombre\nCorreo: $email\n\nMensaje:\n$mensaje";
    $cabeceras = "From: $email\r\n";
    $cabeceras .= "Reply-To: $email\r\n";
    $cabeceras .= "X-Mailer: PHP/" . phpversion();

    // Enviar correo
    if (mail($para, $titulo, $mensaje_correo, $cabeceras)) {
        echo "Gracias por tu mensaje. Nos pondremos en contacto contigo pronto.";
    } else {
        echo "Hubo un error al enviar el correo. Por favor, intenta de nuevo.";
    }
}
?>
