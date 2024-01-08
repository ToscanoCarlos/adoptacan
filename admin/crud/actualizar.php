<?php

require '../../includes/funciones.php';
// $auth = estaAutenticado();

// if(!$auth){
//     header('Location: /bienesraices');
// }

// Validar ID 
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if(!$id) {
    header('Location: /adoptacan/admin/index.php');
}

//Base de Datos
require '../../includes/config/database.php';
$db = conectarDB();

// Obtener los datos de la perro
$consultaPerro = "SELECT * FROM perro WHERE idPerro = ${id}";
$resultadoPerro = mysqli_query($db, $consultaPerro);
$perro = mysqli_fetch_assoc($resultadoPerro);


// Consultar para obtener los vendedores
// $consulta = "SELECT * FROM vendedores";
// $resultado = mysqli_query($db, $consulta);

// Arreglo con mensajes de errores
$errores = [];

$nombre = $perro['nombre'];
$raza = $perro['raza'];
$edad = $perro['edad'];
$genero = $perro['genero'];
$descripcion = $perro['descripcion'];
$extra = $perro['extra'];
$imagen = $perro['imagen'];
$Refugio_idRefugio = $perro['Refugio_idRefugio'];




// Ejecutar despues de que el usuario envia el formulario
if($_SERVER['REQUEST_METHOD'] === 'POST') {

    // echo "<pre>";
    // var_dump($_POST);
    // echo "</pre>";

    // echo "<pre>";
    // var_dump($_FILES);
    // echo "</pre>";

 
    $nombre = mysqli_real_escape_string($db, $_POST['nombre']) ;
    $raza = mysqli_real_escape_string($db, $_POST['raza']) ;
    $edad = mysqli_real_escape_string($db, $_POST['edad']) ;
    $genero = mysqli_real_escape_string($db, $_POST['genero']) ;
    $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']) ;
    $extra = mysqli_real_escape_string($db, $_POST['extra']) ;
    $imagen = mysqli_real_escape_string($db, $_POST['imagen']) ;
    $Refugio_idRefugio = mysqli_real_escape_string($db, $_POST['Refugio_idRefugio']) ;
    
    // Asignar files hacia una variable
    $imagen = $_FILES['imagen'];

    if(!$nombre) {
        $errores[] = "Debes añadir un nombre";
    }

    if(!$raza) {
        $errores[] = "La raza es obligatorio (En caso de no tener, poner 'Sin raza')";
    }

    if( strlen( $edad ) > 3 ) {
        $errores[] = 'La edad es obligatoria y no puede contener más de 3 caracteres';
    }

    if( !$genero ) {
        $errores[] = 'El genero es obligatorio';
    }

    if(!$descripcion) {
        $errores[] = "La descripción es obligatoria";
    }

    if(!$extra) {
        $errores[] = "En caso de no tener información extra, poner 'Sin información extra'";
    }

    if(!$imagen['name'] || $imagen['error']) {
        $errores[] = "La imagen es obligatoria";
    }

    if(!$Refugio_idRefugio) {
        $errores[] = "Elige un refugio asociado al perro";
    }


    // Validar por tamaño (1mb maximo)
    $medida = 1000 * 1000;

    if($imagen['size'] > $medida) {
        $errores[] = "La imagen es muy pesada";
    }

    // echo "<pre>";
    // var_dump($errores);
    // echo "</pre>";

    //Revisar que el arreglo de errores este vacio
    if(empty($errores)) {

        // Crear carpeta
        $carpetaImagenes = '../../imagenes/';

        if(!is_dir($carpetaImagenes)) {
            mkdir($carpetaImagenes);
        }

        $nombreImagen = '';

        /** SUBIDA DE ARCHIVOS */

        if($imagen['name']) {
            // Eliminar la imagen previa

            unlink($carpetaImagenes . $perro['imagen']);

            // // Generar un nombre único
            $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";

            // // Subir la imagen
            move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen );
        } else {
            $nombreImagen = $perro['imagen'];
        }

        

        //Insertar en la base de datos
        $query = " UPDATE perro SET
        nombre = '${nombre}',
        raza = '${raza}',
        edad = '${edad}',
        genero = '${genero}',
        descripcion = '${descripcion}',
        extra = '${extra}',
        imagen = '${nombreImagen}',
        Refugio_idRefugio = '${Refugio_idRefugio}'
        WHERE idPerro = ${id} ";
        // echo $query;
        $resultado = mysqli_query($db, $query);
        if($resultado) {
            // Redireccionar al usuario.
            header('Location: /adoptacan/admin/index.php?resultado=2');
        }
    }

    
}

incluirTemplate('header');
?>


<main class="contenedor seccion">
    <h1>Actualizar Perro</h1>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="form-contact contact_form" method="POST" id="contactForm" enctype="multipart/form-data">

        <?php include '../../includes/templates/formulario_perros.php'; ?>
        <input type="submit" value="Actualizar Perro" class="boton boton-verde">
    </form>

</main>

<?php
incluirTemplate('footer');
?>