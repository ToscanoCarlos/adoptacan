<?php

    require 'funciones.php';
    require 'config/database.php';
    require __DIR__ . '/../vendor/autoload.php';

    use App\ActiveRecord;
    use App\Perro;

    $perro = new Perro();


    
    // require 'config/database.php';
    // require __DIR__ . '/../vendor/autoload.php';

    // // Conectar a la base de datos
    // $db = conectarDB();

    // use App\ActiveRecord;

    // ActiveRecord::setDB($db);




