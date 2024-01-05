<?php

    require 'funciones.php';
    require 'config/database.php';
    require __DIR__ . '/../vendor/autoload.php';

    $db = conectarDB();

    use App\ActiveRecord;
    use App\Perro;

    ActiveRecord::setDB($db);


    
    // require 'config/database.php';
    // require __DIR__ . '/../vendor/autoload.php';

    // // Conectar a la base de datos
    // $db = conectarDB();

    // use App\ActiveRecord;

    // ActiveRecord::setDB($db);




