<?php

namespace App;

class Refugio extends ActiveRecord{
    protected static $tabla = 'refugio';
    protected static $id = 'idRefugio';
    protected static $columnasDB = ['idRefugio', 'nombre', 'email', 'telefono', 'ubicacion'];
    
    public $idRefugio;
    public $nombre;
    public $email;
    public $telefono;
    public $ubicacion;

    public function __construct($args = [])
    {
        $this->idRefugio = $args['idRefugio'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        
    }

    public function validar() {
        if(!$this->nombre) {
            self::$errores[] = "El nombre es obligatorio";
        }

        if(!$this->email) {
            self::$errores[] = "El email es obligatorio";
        }

        if(!$this->telefono) {
            self::$errores[] = "El número de telefono es obligatorio";
        }

        if(!preg_match('/[0-9]{10}/', $this->telefono)) {
            self::$errores[] = "El número de telefono debe tener 10 digitos";
        }

        if(!$this->ubicacion) {
            self::$errores[] = "La ubicación es obligatoria";
        }

        return self::$errores;
    }
}