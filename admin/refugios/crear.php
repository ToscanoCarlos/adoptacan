<?php

    require '../../includes/funciones.php';
    $auth = estaAutenticado();

    if(!$auth){
        header('Location: /adoptacan/index.php');
    }

    //Base de Datos
    require '../../includes/config/database.php';
    $db = conectarDB();

    // Arreglo con mensajes de errores
    $errores = [];

    $nombre = '';
    $email = '';
    $telefono = '';
    $ubicacion = '';


    // Ejecutar despues de que el usuario envia el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        // echo "<pre>";
        // var_dump($_POST);
        // echo "</pre>";

        // exit;

        // echo "<pre>";
        // var_dump($_FILES);
        // echo "</pre>";

        $nombre = mysqli_real_escape_string($db, $_POST['nombre']) ;
        $email = mysqli_real_escape_string($db, $_POST['email']) ;
        $telefono = mysqli_real_escape_string($db, $_POST['telefono']) ;
        $ubicacion = mysqli_real_escape_string($db, $_POST['ubicacion']) ;
        
        // Asignar files hacia una variable
        $imagen = $_FILES['imagen'];

        if(!$nombre) {
            $errores[] = "Debes añadir un nombre";
        }

        if(!$email) {
            $errores[] = "El email es obligatorio";
        }

        if(!$telefono) {
            $errores[] = "El telefono es obligatorio";
        }

        if(!$ubicacion) {
            $errores[] = "La ubicacion es obligatorio";
        }


        // echo "<pre>";
        // var_dump($errores);
        // echo "</pre>";

        //Revisar que el arreglo de errores este vacio
        if(empty($errores)) {

            // Subida de Archivos

            // Crear carpeta

            // Crear carpeta
            

            //Insertar en la base de datos
            $query = " INSERT INTO refugio (nombre, email, telefono, ubicacion) VALUES ('$nombre', '$email', '$telefono', '$ubicacion') ";
            // echo $query;

            // echo "<pre>";
            // var_dump($query);
            // echo "</pre>";


            $resultado = mysqli_query($db, $query);


            if($resultado) {
                // Redireccionar al usuario.
                header('Location: /adoptacan/admin/index.php?resultado=1');
            }



        }

        
    }

    incluirTemplate('header');
?>


    
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
<a href="/adoptacan/admin/index.php" class="button button-contactForm boxed-btn">Volver</a>

<section class="contact-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="contact-title">A continuación proporciona los datos</h2>
            </div>
            <div class="col-lg-8">
                <form class="form-contact contact_form" action="/adoptacan/admin/refugios/crear.php" method="POST" >
                    <?php include '../../includes/templates/formulario_refugios.php'; ?>


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