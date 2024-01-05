<?php
require 'includes/app.php';

use App\ActiveRecord;
use Intervention\Image\ImageManagerStatic as Image;

// use App\refugio;

//estaAutenticado();

$db = conectarDB();

$perro = new ActiveRecord;

// Consultar para obtener los refugioes
$consulta = "SELECT * FROM perro";
$resultado = mysqli_query($db, $consulta);


// Arreglo con mensajes de errores
$errores = ActiveRecord::getErrores();

// Ejecutar despues de que el usuario envia el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $perro = new ActiveRecord($_POST['perro']);

    // Generar un nombre único
    $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

    // Realiza un resize a la imagen con intervention
    if ($_FILES['perro']['tmp_name']['imagen']) {
        $image = Image::make($_FILES['perro']['tmp_name']['imagen'])->fit(800, 600);
        $perro->setImagen($nombreImagen);
    }

    // Validar
    $errores = $perro->validar();

    if (empty($errores)) {

        $perro->guardar();

        //Crear carpeta de imagenes
        if (!is_dir(CARPETA_IMAGENES)) {
            mkdir(CARPETA_IMAGENES);
        }

        $image->save(CARPETA_IMAGENES . $nombreImagen);

        // Guardar en la base de datos
        $resultado = $perro->guardar();

    }
}

incluirTemplate('header');
?>
<!-- header_start  -->

<!-- bradcam_area_start -->
<div class="bradcam_area breadcam_bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="bradcam_text text-center">
                    <h3>Agregar</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- bradcam_area_end -->

<?php foreach ($errores as $error) : ?>
    <div class="product-item">
        <div class="product-details">
            <p class="product-description">
                <?php echo $error; ?>
            </p>
        </div>
    </div>
<?php endforeach; ?>

<!-- ================ contact section start ================= -->
<section class="contact-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="contact-title">A continuación proporciona los datos</h2>
            </div>
            <div class="col-lg-8">
                <form class="form-contact contact_form" action="/add.php" method="POST" id="contactForm" novalidate="novalidate" enctype="multipart/form-data">
                    <?php include 'includes/templates/formulario_perros.php'; ?>


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