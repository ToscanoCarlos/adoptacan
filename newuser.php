<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

// Importar la conexión
require 'includes/funciones.php';
require 'includes/config/database.php';
require 'vendor/autoload.php';
$db = conectarDB();

$mail = new PHPMailer(true);

$errores = [];

// Crear un email y password
$usuario = '';
$email = '';
$telefono = '';
$password = '';
$password2 = '';



if($_SERVER['REQUEST_METHOD'] === 'POST') {
    // echo "<pre>";
    // var_dump($_POST);
    // echo "</pre>";

    $usuario = mysqli_real_escape_string($db, filter_var($_POST['usuario']));
    $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
    $telefono = mysqli_real_escape_string($db, filter_var($_POST['telefono']));
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $password2 = mysqli_real_escape_string($db, $_POST['password2']);
    $isAdmin = mysqli_real_escape_string($db, $_POST['isAdmin']);

    if(!$usuario) {
        $errores[] = "El usuario es obligatorio";
    }

    if(!$email) {
        $errores[] = "El email es obligatorio o no es válido";
    }

    if(!$telefono) {
        $errores[] = "El telefono es obligatorio";
    }

    if(!$password) {
        $errores[] = "El password es obligatorio";
    }

    if(!$password2) {
        $errores[] = "La verificacion es obligatoria";
    }

    if($password !== $password2) {
        $errores[] = "Los passwords no son iguales";
    }

    if(!$isAdmin) {
        $errores[] = "El isAdmin es obligatorio";
    }

    if (empty($errores)) {
        // Verificar si el correo ya está registrado
        $query = "SELECT * FROM usuario WHERE email = '$email'";
        $resultado = mysqli_query($db, $query);
        $isAdmin = 0;

        if (mysqli_num_rows($resultado) > 0) {
            $errores[] = "El correo ya ha sido registrado";
        } else {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $token = bin2hex(random_bytes(32));
            $query = "INSERT INTO usuario(usuario, email,telefono, password,isAdmin ,token, validation) VALUES('$usuario', '$email','$telefono', '$passwordHash','$isAdmin', '$token', 'NO')";
            $resultado = mysqli_query($db, $query);

            if ($resultado) {
                try {    
                    // Construir el enlace de recuperación de contraseña con el token
                    $resetLink = "http://localhost/adoptacan/verificacion.php?token=" . $token;
                    $message = "Hola,\n\nPara verificar tu cuenta/correo, haz clic en el siguiente enlace:\n\n" . $resetLink . "\n\nSi no solicitaste un registro, puedes ignorar este correo.\n\nSaludos,";
                    
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
                    $mail->Subject = 'Verificacion de Cuenta';
                    $mail->Body    =  $message;
                    // Enviar el correo electrónico
                    $mail->send();
                    
                    header('Location: index.php');
                    } catch (Exception $e) {
                        echo 'Error al enviar el correo: ' . $mail->ErrorInfo;
                    }
            }
          
        }
    }
}



incluirTemplate('header');
?>
<div class="bradcam_area breadcam_bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="bradcam_text text-center">
                    <h3>Crear Usuario</h3>
                </div>
            </div>
        </div>
    </div>
</div>


<?php foreach ($errores as $error) : ?>
    <div class="product-item">
        <div class="product-details">
            <p class="product-description">
                <?php echo $error; ?>
            </p>
        </div>
    </div>
<?php endforeach; ?>

<a href="/adoptacan/login.php" class="button button-contactForm boxed-btn">Volver</a>
<section class="contact-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="contact-title">A continuación proporciona los datos</h2>
            </div>
            <div class="col-lg-8">
                <form class="form-contact contact_form" action="/adoptacan/newuser.php" method="POST" >
                    <?php include 'includes/templates/formulario_usuario.php'; ?>


                    <input type="submit" class="button button-contactForm boxed-btn" value="Enviar">
                </form>
            </div>
            <div class="col-lg-3 offset-lg-1">
                <div class="media contact-info">
                    <span class="contact-info__icon"><i class="ti-home"></i></span>
                    <div class="media-body">
                        <h3>Gustavo A. Madero</h3>
                        <p>ESCOM IPN MX</p>
                    </div>
                </div>
                <div class="media contact-info">
                    <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                    <div class="media-body">
                        <h3>+55 12341234</h3>
                        <p>Lunes a Viernes 7 A 13 hrs</p>
                    </div>
                </div>
                <div class="media contact-info">
                    <span class="contact-info__icon"><i class="ti-email"></i></span>
                    <div class="media-body">
                        <h3>adoptacan@gmail.com</h3>
                        <p>Envia tus comentarios en cualquier momento</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ================ contact section end ================= -->

<!-- footer_start  -->
<?php
incluirTemplate('footer');
?>
