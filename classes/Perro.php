<?php

    namespace App;

    class Perro extends ActiveRecord{
        protected static $tabla = 'perro';
        protected static $columnasDB = ['idPerro', 'nombre', 'raza', 'edad', 'genero', 'descripcion', 'extra', 'imagen', 'Refugio_idRefugio'];
    
        public $idPerro;
        public $nombre;
        public $raza;
        public $edad;
        public $genero;
        public $descripcion;
        public $extra;
        public $imagen;
        public $Refugio_idRefugio;

        public function __construct($args = [])
        {
            $this->idPerro = $args['idPerro'] ?? '';
            $this->nombre = $args['nombre'] ?? '';
            $this->raza = $args['raza'] ?? '';
            $this->edad = $args['edad'] ?? '';
            $this->genero = $args['genero'] ?? '';
            $this->descripcion = $args['descripcion'] ?? '';
            $this->extra = $args['extra'] ?? '';
            $this->imagen = $args['imagen'] ?? '';
            $this->Refugio_idRefugio = $args['Refugio_idRefugio'] ?? '';
            
        }

        public function validPerroar() {
            if(!$this->nombre) {
                self::$errores[] = "Debes añadir un nombre";
            }
    
            if(!$this->raza) {
                self::$errores[] = "La raza es obligatorio (En caso de no tener, poner 'Sin raza')";
            }
    
            if( strlen( $this->edad ) > 3 ) {
                self::$errores[] = 'La edad es obligatoria y no puede contener más de 3 caracteres';
            }
    
            if( !$this->genero ) {
                self::$errores[] = 'El genero es obligatorio';
            }
    
            if(!$this->descripcion) {
                self::$errores[] = "La descripción es obligatoria";
            }
    
            if(!$this->extra) {
                self::$errores[] = "En caso de no tener información extra, poner 'Sin información extra'";
            }
    
            if(!$this->imagen) {
                self::$errores[] = "La imagen es obligatoria";
            }
    
            if(!$this->Refugio_idRefugio) {
                self::$errores[] = "Elige un refugio asociado al perro";
            }
    
    
            return self::$errores;
        }
    }