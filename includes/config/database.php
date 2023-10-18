<?php 

function conectarDB() : mysqli{
    $db =  new mysqli('localhost', 'root', '12345', 'adoptacan');
    

    if(!$db) {
        echo "Error no se pudo conectar";
        exit;
    }
    return $db;
}