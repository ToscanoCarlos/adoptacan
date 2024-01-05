<?php

namespace App;

class ActiveRecord{

    // Base de datos
    protected static $db;
    protected static $columnasDB = [];
    protected static $tabla = '';
    protected static $id = '';

    //Errores   
    protected static $errores = [];


    //Definir la conexion a la base de datos
    public static function setDB($database){
        self::$db = $database;
    }

    public function guardar(){
        if(!is_null($this->id)){
            $this->actualizar();
        } else {
            $this->crear();
        }
    }

    public function actualizar(){
        //Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        $valores = [];
        foreach($atributos as $key => $value){
            $valores[] = "{$key} = '{$value}'";
        }

        $query = " UPDATE " . static::$tabla . " SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE " . static::$id . " = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 ";

        $resultado = self::$db->query($query);

        if($resultado){
            header('Location: /anipat-master/admin/index.php?resultado=2');
        }


    }

    public function crear(){
        //Sanitizar los datos
        $atributos = $this->sanitizarAtributos();


        debuguear($atributos);
        //Insertar en la base de datos
        $query = " INSERT INTO " . static::$tabla . " ( ";
        $query .=  join(', ', array_keys($atributos));
        $query .= " ) VALUES (' ";
        $query .=  join("', '", array_values($atributos));
        $query .= " ') ";
 
        $resultado = self::$db->query($query);

        if($resultado){
            header('Location: /anipat-master/index.php?resultado=1');
        }


    }

    public function eliminar(){
        $query = "DELETE FROM " . static::$tabla . " WHERE " . static::$id . " = '" . self::$db->escape_string($this->id) . "' LIMIT 1";
        $resultado = self::$db->query($query);

        if($resultado){
            $this->borrarImagen();
            header('Location: /anipat-master/admin/index.php?resultado=3');
        }



    }

    public function atributos(){
        $atributos = [];
        foreach(self::$columnasDB as $columna){
            if($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }


    public function sanitizarAtributos(){
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach($atributos as $key => $value){
            $sanitizado[$key] = self::$db->escape_string($value);
        }

        return $sanitizado;
    }
    //Subida de archivos
    public function setImagen($imagen){
        //Elimina la imagen previa
        if(!is_null($this->id)){
            $this->borrarImagen();
        }
        // Asignar al atributo de imagen el nombre de la imagen
        if($imagen){
            $this->imagen = $imagen;
        }
    }

    //Elimina el archivo
    public function borrarImagen(){
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        if($existeArchivo){
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }


    // Validacion
    public static function getErrores(){
        return self::$errores;
    }
    
    

    //Lista todos los perros
    public static function all(){
        $query = "SELECT * FROM " . static::$tabla;

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    //Buscar un perro por id
    public static function find($id){
        $query = "SELECT * FROM " . static::$tabla . " WHERE " . static::$id . " = ${id}";

        $resultado = self::consultarSQL($query);

        return array_shift($resultado);
    }

    public static function consultarSQL ($query){
        //Consultar la base de datos
        $resultado = self::$db->query($query);

        //Iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()){
            $array[] = self::crearObjeto($registro);
        }

        //Liberar la memoria
        $resultado->free();

        //Retornar los resultados
        return $array;
    }

    protected static function crearObjeto($registro){
        $objeto = new static;

        foreach($registro as $key => $value){
            if(property_exists($objeto, $key)){
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }

    //Sicroniza el objeto en memoria con los cambios realizados por el usuario{
    public function sincronizar($args = []){
        foreach($args as $key => $value){
            if(property_exists($this, $key) && !is_null($value)){
                $this->$key = $value;
            }
        }
    }
}