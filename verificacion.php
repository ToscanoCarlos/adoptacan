<?php

require 'includes/config/database.php';
$db = conectarDB();

$errores = [];
$token = $_GET['token'];

$query = "UPDATE usuario SET validation = 'YES' WHERE token = '$token'";
mysqli_query($db, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificación</title>
</head>

<body>
    <main class="contenedor seccion contenido-centrado">
        <br><br><br><br><br>
        <h1>Se ha verificado correctamente la cuenta</h1>
        <br><br><br><br><br>
    </main>
</body>

</html>