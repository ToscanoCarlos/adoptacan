<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'includes/funciones.php';
require 'includes/config/database.php';
require 'vendor/autoload.php';

$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);



$db = conectarDB();
$mail = new PHPMailer(true);

// Obtener los datos de la perro
$consultaPerro = "SELECT idPerro,nombre,Refugio_idRefugio FROM perro WHERE idPerro = ${id}";
// $queryPerro = "SELECT idPerro, nombre FROM perro WHERE idPerro = ${id}";
// $queryRefugio = "SELECT nombre FROM refugio WHERE idRefugio = ${id}";
$resultadoPerro = mysqli_query($db, $consultaPerro);
$perro = mysqli_fetch_assoc($resultadoPerro);


$mail = new PHPMailer(true);
$errores = [];

$nombre = '';
$apellido = '';
$edad = '';
$direccion = '';
$ciudad = '';
$codigo_postal = '';
$email = '';
$telefono = '';
$experiencia_mantenimiento_mascotas = '';
$motivo_adopcion = '';
$espacio_disponible = '';
$idPerro = $perro['idPerro'];
$nombrePerro = $perro['nombre'];
$idRefugio = $perro['Refugio_idRefugio'];

$consultaRefugio = "SELECT nombre FROM refugio WHERE idRefugio = $idRefugio";
$resultadoRefugio = mysqli_query($db, $consultaRefugio);
$refugio = mysqli_fetch_assoc($resultadoRefugio);

$refugioNombre = $refugio['nombre'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = mysqli_real_escape_string($db, $_POST['nombre']);
    $apellido = mysqli_real_escape_string($db, $_POST['apellido']);
    $edad = mysqli_real_escape_string($db, $_POST['edad']);
    $direccion = mysqli_real_escape_string($db, $_POST['direccion']);
    $ciudad = mysqli_real_escape_string($db, $_POST['ciudad']);
    $codigo_postal = mysqli_real_escape_string($db, $_POST['codigo_postal']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $telefono = mysqli_real_escape_string($db, $_POST['telefono']);
    $experiencia_mantenimiento_mascotas = mysqli_real_escape_string($db, $_POST['experiencia_mantenimiento_mascotas']);
    $motivo_adopcion = mysqli_real_escape_string($db, $_POST['motivo_adopcion']);
    $espacio_disponible = mysqli_real_escape_string($db, $_POST['espacio_disponible']);
    $nombrePerro = mysqli_real_escape_string($db, $_POST['nombrePerro']);
    $perroId = mysqli_real_escape_string($db, $_POST['perroId']);
    $refugioNombre = mysqli_real_escape_string($db, $_POST['$refugioNombre']);



    if (!$nombre) {
        $errores[] = "Debes añadir un nombre";
    }

    if (!$apellido) {
        $errores[] = "Debes añadir un apellido";
    }

    if (!$edad) {
        $errores[] = "Debes añadir una edad";
    }

    if (!$direccion) {
        $errores[] = "Debes añadir una direccion";
    }

    if (!$ciudad) {
        $errores[] = "Debes añadir una ciudad";
    }

    if (!$codigo_postal) {
        $errores[] = "Debes añadir un codigo postal";
    }

    if (!$email) {
        $errores[] = "Debes añadir un email";
    }

    if (!$telefono) {
        $errores[] = "Debes añadir un telefono";
    }

    if (!$experiencia_mantenimiento_mascotas) {
        $errores[] = "Debes añadir una experiencia en mantenimiento de mascotas";
    }

    if (!$motivo_adopcion) {
        $errores[] = "Debes añadir un motivo de adopcion";
    }

    if (!$espacio_disponible) {
        $errores[] = "Debes añadir un espacio disponible";
    }

    if (empty($errores)) {
        $query = "SELECT * FROM adoptantes WHERE email = '$email'";
        $resultado = mysqli_query($db, $query);

        if (mysqli_num_rows($resultado) > 0) {
            $errores[] = "El correo ya ha sido registrado";
        } else {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO adoptantes(nombre, apellido, edad, direccion, ciudad, codigo_postal, email, telefono, experiencia_mantenimiento_mascotas, motivo_adopcion, espacio_disponible) VALUES('$nombre', '$apellido', '$edad', '$direccion', '$ciudad', '$codigo_postal', '$email', '$telefono', '$experiencia_mantenimiento_mascotas', '$motivo_adopcion', '$espacio_disponible')";
            $resultado = mysqli_query($db, $query);

            if ($resultado) {
                try {
                    // Construir el enlace de recuperación de contraseña con el token


                    
                    $message = "
<html>
<head>
  <title>Solicitud de adopción de perro</title>
</head>
<body>
  <h2>Solicitud de adopción de perro</h2>
  <p>Nombre: $nombre</p>
  <p>Apellido: $apellido</p>
  <p>Edad: $edad</p>
  <p>Dirección: $direccion</p>
  <p>Ciudad: $ciudad</p>
  <p>Código Postal: $codigo_postal</p>
  <p>Correo Electrónico: $email</p>
  <p>Teléfono: $telefono</p>
  <p>Experiencia en mantenimiento de mascotas: $experiencia_mantenimiento_mascotas</p>
  <p>Motivo de adopción: $motivo_adopcion</p>
  <p>Espacio disponible: $espacio_disponible</p>
  <p>Refugio asociado: $refugioNombre</p>
                    <p>Nombre del perro: $perroNombre</p>
                    <p>ID del perro: $perroId</p>
</body>
</html>
";
debuguear($message);
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
                    $mail->Subject = 'Solicitud de adopcion de perro';
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
                    <h3>Llenado de formulario para Solicitud de Adopción</h3>
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
                <form class="form-contact contact_form" method="POST">
                    <?php include 'includes/templates/formulario_adoptante.php'; ?>


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