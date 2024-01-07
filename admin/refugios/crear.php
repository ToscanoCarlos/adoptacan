<?php
require '../../includes/app.php';

use App\Refugio;

//estaAutenticado();

$refugio = new Refugio;

// Arreglo con mensajes de errores
$errores = Refugio::getErrores();

// Ejecutar despues de que el usuario envia el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Crear una nueva instancia
    $refugio = new Refugio($_POST['refugio']);
    // Validar campos
    $errores = $refugio->validar();
    //No hay errores
    if (empty($errores)) {
        $resultado = $refugio->guardar();
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
                <h2 class="contact-title">Registrar Refugio</h2>
            </div>
            <div class="col-lg-8">
                <form class="form-contact contact_form" action="/anipat-master/refugios/crear.php" method="POST" >
                    <?php include '../../includes/templates/formulario_refugios.php'; ?>


                    <input type="submit" class="button button-contactForm boxed-btn" value="Enviar">
                </form>
            </div>
        </div>
    </div>
</section>
<!-- ================ contact section end ================= -->

<!-- footer_start  -->
<?php
incluirTemplate('footer');
?>