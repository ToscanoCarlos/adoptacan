<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'includes/funciones.php';
require 'includes/config/database.php';
require 'vendor/autoload.php';

//Crear una instancia pasando `true` habilita las excepciones
$mail = new PHPMailer(true);

$db = conectarDB();
incluirTemplate('header');

$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));

  if (!$email) {
    $errores[] = "El email es obligatorio o no es válido";
  }

  // Revisar si el usuario existe.
  $query = "SELECT * FROM usuario WHERE email = '$email' ";
  $resultado = mysqli_query($db, $query);

  if ($resultado->num_rows) {
    if (empty($errores)) {

      try {
        // Generar un token único
        $sql = "SELECT token FROM usuario WHERE email = '$email'";
        $result = mysqli_query($db, $query);
        $row = mysqli_fetch_assoc($result);
        $token = $row['token'];
        $token = strval($token); // Convertir el token a string   

        // Construir el enlace de recuperación de contraseña con el token
        $resetLink = "http://localhost/adoptacan/nueva-pass.php?token=" . $token;
        $message = "Hola,\n\nPara restablecer tu contraseña, haz clic en el siguiente enlace:\n\n" . $resetLink . "\n\nSi no solicitaste un restablecimiento de contraseña, puedes ignorar este correo.\n\nSaludos,";

        // Configuración del servidor SMTP de Gmail
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'davidoconer555@gmail.com'; // Tu dirección de correo electrónico de Gmail
        $mail->Password   = 'cxcdngwlbfqeznii'; // Tu contraseña de Gmail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Configuración de remitente y destinatario
        $mail->setFrom('davidoconer555@gmail.com', 'Oscar Romero');
        $mail->addAddress($email, $email);

        // Configuración del correo electrónico
        $mail->isHTML(true);
        $mail->Subject = 'Reestablecimiento de Password';
        $mail->Body    =  $message;
        // Enviar el correo electrónico
        $mail->send();

        echo 'Correo enviado correctamente';
      } catch (Exception $e) {
        echo 'Error al enviar el correo: ' . $mail->ErrorInfo;
      }
    }
  } else {
    $errores[] = "El Usuario no existe";
  }
}
?>

<main class="contenedor seccion contenido-centrado">
  <h1>Recuperar Contraseña</h1>

  <?php foreach ($errores as $error) : ?>
    <div class="alerta error">
      <?php echo $error; ?>
    </div>
  <?php endforeach; ?>

  <form method="POST" class="formulario" novalidate>
    <div class="form-group">
      <label for="email">Ingresa tu correo electrónico:</label>
      <p class="alerta exito">Se te enviara un un token de recuperación a dicho correo</p>
      <input type="email" name="email" id="email" placeholder="Tu Correo Electrónico" required>
    </div>

    <input type="submit" value="Enviar" class="boton boton-verde">
  </form>

  <div class="extras">
    <div class="volver-inicio">
      <a class="boton-amarillo" href="index.php">Volver a la pagina de inicio</a>
    </div>
  </div>
</main>

<?php
incluirTemplate('footer');
?>