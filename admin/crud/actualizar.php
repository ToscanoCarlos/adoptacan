<?php

use App\Perro;
use App\Refugio;
use Intervention\Image\ImageManagerStatic as Image;

    require '../../includes/app.php';
    estaAutenticado();

    if(!$auth){
        header('Location: /bienesraices');
    }

    // Validar ID 
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id) {
        header('Location: /bienesraices/admin/index.php');
    }

    // Obtener los datos del perro
    $perro = Perro::find($id);

    // Consulta para obtener todos los refugios
    $refugio = Refugio::all();

    // Arreglo con mensajes de errores
    $errores = Perro::getErrores();

    // Ejecutar despues de que el usuario envia el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        $args = [$_POST['perro']];

        $perro->sincronizar($args);

        // Validacion
        $errores = $perro->validar();

        // Generar un nombre único
        $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

        // Subida de archivos
        if ($_FILES['perro']['tmp_name']['imagen']) {
            $image = Image::make($_FILES['perro']['tmp_name']['imagen'])->fit(800, 600);
            $perro->setImagen($nombreImagen);
        }

        //Revisar que el arreglo de errores este vacio
        if(empty($errores)) {
            if ($_FILES['perro']['tmp_name']['imagen']) {
                // Almacenar la imagen
                $image->save(CARPETA_IMAGENES . $nombreImagen);
            }

            $perro->guardar();

        }

        
    }

    incluirTemplate('header');
?>


    <main class="contenedor seccion">
        <h1>Actualizar Perro</h1>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form class="form-contact contact_form" action="/add.php" method="POST" id="contactForm" novalidate="novalidate" enctype="multipart/form-data">
            
        <?php include '../../includes/templates/formulario_perros.php'; ?>
            <input type="submit" value="Actualizar Perro" class="boton boton-verde">
        </form>

    </main>

<?php
    incluirTemplate('footer');
?>