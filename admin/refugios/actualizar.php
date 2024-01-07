<?php
require '../../includes/app.php';

use App\Refugio;

//estaAutenticado();

// Validar la URL por ID válido
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: /anipat-master/admin/index.php');
}

//Obtener el refugio
$refugio = Refugio::find($id);

// Arreglo con mensajes de errores
$errores = Refugio::getErrores();

// Ejecutar despues de que el usuario envia el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Asignar los atributos
    $args = $_POST['refugio'];

    // Sincronizar objeto en memoria con lo que el usuario escribió
    $refugio->sincronizar($args);

    // Validación
    $errores = $refugio->validar();

    if (empty($errores)) {
        // No hay errores
        $refugio->guardar();
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
                <h2 class="contact-title">Actualizar Refugio</h2>
            </div>
            <div class="col-lg-8">
                <form class="form-contact contact_form" action="/anipat-master/refugios/actualizar.php" method="POST" >
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