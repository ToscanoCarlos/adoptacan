<?php

require '../../includes/funciones.php';
$auth = estaAutenticado();

if(!$auth){
    header('Location: /adoptacan/index.php');
}

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
$consultaRefugio = "SELECT * FROM refugio WHERE idRefugio = ${id}";
$resultadoRefugio = mysqli_query($db, $consultaRefugio);
$refugio = mysqli_fetch_assoc($resultadoRefugio);


// Consultar para obtener los vendedores
// $consulta = "SELECT * FROM vendedores";
// $resultado = mysqli_query($db, $consulta);

// Arreglo con mensajes de errores
$errores = [];

$nombre = $refugio['nombre'];
$email = $refugio['email'];
$telefono = $refugio['telefono'];
$ubicacion = $refugio['ubicacion'];




// Ejecutar despues de que el usuario envia el formulario
if($_SERVER['REQUEST_METHOD'] === 'POST') {

    // echo "<pre>";
    // var_dump($_POST);
    // echo "</pre>";

    // echo "<pre>";
    // var_dump($_FILES);
    // echo "</pre>";

 
    $nombre = mysqli_real_escape_string($db, $_POST['nombre']) ;
    $email = mysqli_real_escape_string($db, $_POST['email']) ;
    $telefono = mysqli_real_escape_string($db, $_POST['telefono']) ;
    $ubicacion = mysqli_real_escape_string($db, $_POST['ubicacion']) ;
    
    // Asignar files hacia una variable


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

        // Crear carpeta
       


        //Insertar en la base de datos
        $query = " UPDATE refugio SET
        nombre = '${nombre}',
        email = '${email}',
        telefono = '${telefono}',
        ubicacion = '${ubicacion}'
        WHERE idRefugio = ${id} ";
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
    <h1>Actualizar Refugio</h1>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="form-contact contact_form" method="POST" id="contactForm">

        <?php include '../../includes/templates/formulario_refugios.php'; ?>
        <input type="submit" value="Actualizar Refugio" class="boton boton-verde">
    </form>

</main>

<?php
incluirTemplate('footer');
?>