<?php

require 'includes/funciones.php';
require 'includes/config/database.php';
$db = conectarDB();

$errores = [];
$token = $_GET['token'];


//Autenticar el usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $password = mysqli_real_escape_string($db,  $_POST['password']);
    $password2 = mysqli_real_escape_string($db,  $_POST['password2']);

    if (!$password) {
        $errores[] = "El Password es obligatorio";
    }

    if (!$password2) {
        $errores[] = "La verificación de Password es obligatorio";
    }

    if ($password != $password2) {
        $errores[] = "Las contraseñas no coinciden";
    }

    if (empty($errores)) {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $query = "UPDATE usuario SET password = '$passwordHash' WHERE token = '$token'";
        $resultado = mysqli_query($db, $query);


        if ($resultado) {
            header('Location: /adoptacan/index.php');
        }
    }
    
}
incluirTemplate('header');

?>

<main class="contenedor seccion contenido-centrado">
    <h1>CAMBIO DE CONTRASEÑA</h1>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form method="POST" class="formulario" >
        <fieldset>
            <legend>Cambio de Password</legend>

            <div class="row">

                <div class="col-sm-6">
                    <div class="form-group">
                        <input class="form-control" name="password" id="password" type="password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ingresa la contraseña'" placeholder="Contraseña">
                    </div>
                </div>
                <div class=" col-sm-6">
                    <div class="form-group">
                        <input class="form-control" name="password2" id="password2" type="password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Verifica la contraseña'" placeholder="Verifica Contraseña">
                    </div>
                </div>
            </div>
        </fieldset>

        <input type="submit" value="Registro" class="boton boton-amarillo">
    </form>
</main>

<?php
incluirTemplate('footer');
?>