<?php

// Importar la conexión
require 'includes/config/database.php';
$db = conectarDB();

// Crear un email y password
$usuario = "usuario";
$email = "correo@correo.com";
$telefono = "1234567890";
$password = "123456";
$isAdmin = 1;

$passwordHash = password_hash($password, PASSWORD_BCRYPT);


// Query para crear el usuario
$query = " INSERT INTO usuario (usuario, email, telefono, password, isAdmin) VALUES ('${usuario}', '${email}', '${telefono}', '${passwordHash}', '${isAdmin}') ";

echo $query;

// // Agregarlo a la base de datos
mysqli_query($db, $query);

