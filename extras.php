
$nombre = '';
    $raza = '';
    $edad = '';
    $genero = '';
    $descripcion = '';
    $extra = '';
    $imagen = '';
    $Refugio_idRefugio = '';


$query = " INSERT INTO perro (nombre, raza, edad, genero, descripcion, extra, imagen, Refugio_idRefugio) 
        VALUES ( '$this->nombre' , '$this->raza' , '$this->edad' , '$this->genero' , '$this->descripcion' , '$this->extra' , '$this->imagen' , '$this->Refugio_idRefugio' ) ";
        

//Base de datos

    protected static $db; //static para que no se tenga que instanciar la clase
    protected static $columnasDB = [];
    protected static $tabla = '';
    //Errores
    protected static $errores = [];


    // Definir la conexion a la base de datos
    public static function setDB($database){
        self::$db = $database;
    }

    // public function guardar(){
    //     if(isset($this->id)){
    //         //Actualizar
    //         $this->actualizar();
    //     } else {
    //         //Crear un registro
    //         $this->crear();
    //     }
    // }

    public function crear(){

        //Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        //Insertar en la base de datos
        $query = " INSERT INTO " . static::$tabla . " ( ";
        $query .=  join(', ', array_keys($atributos));
        $query .= " ) VALUES (' "; 
        $query .=  join("', '", array_values($atributos));
        $query .= " ') ";

        $resultado = self::$db->query($query);

        if($resultado) {
            // Redireccionar al usuario.
            header('Location: /bienesraices2/admin/index.php?resultado=1');
        }
    }

    // public function actualizar (){
            
    //     //Sanitizar los datos
    //     $atributos = $this->sanitizarAtributos();

    //     $valores = [];
    //     foreach($atributos as $key => $value) {
    //         $valores[] = "{$key} = '{$value}'";
    //     }

    //     //Insertar en la base de datos
    //     $query = " UPDATE " . static::$tabla . " SET ";
    //     $query .=  join(', ', $valores);
    //     $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
    //     $query .= " LIMIT 1 ";

    //     $resultado = self::$db->query($query);

    //     if($resultado) {
    //         // Redireccionar al usuario.
    //         header('Location: /bienesraices2/admin/index.php?resultado=2');
    //     }
    // }

    // // Eliminar un registro
    // public function eliminar() {
    //     $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
    //     $resultado = self::$db->query($query);

    //     if($resultado) {
    //         $this->borrarImagen();
    //         header('Location: /bienesraices2/admin/index.php?resultado=3');
    //     }
    // }

    // Identifica y une los atributos de la base de datos
    public function atributos() {
        $atributos = [];
        foreach(static::$columnasDB as $columna) {
            if($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }


    public function sanitizarAtributos() {
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }

        return $sanitizado;
    }

    // //Subida de archivos
    // public function setImagen($imagen){

    //     // Elimina la imagen previa
    //     if(!is_null($this->id)) {
    //         $this->borrarImagen();
    //     }
        
    //     if($imagen) {
    //         // Almacenar la imagen en la propiedad
    //         $this->imagen = $imagen;
    //     }
    // }

    // // Elimina el archivo
    // public function borrarImagen() {
    //     $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
    //     if($existeArchivo) {
    //         unlink(CARPETA_IMAGENES . $this->imagen);
    //     }
    // }

    // Validación
    public static function getErrores() {
        return static::$errores;
    }

    public function validar() {
        static::$errores = [];
        return static::$errores;
    }

    // Listado de propiedades
    public static function all() {
        $query = "SELECT * FROM " . static::$tabla;

        $resultado = self::consultarSQL($query);

        return $resultado;

    }


    // Obtiee determiando numero de registros
    public static function get($cantidad) {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT ${cantidad}";

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    // Busca una propiedad por su id
    public static function find($id) {
        $consultaPropiedad = "SELECT * FROM " . static::$tabla . " WHERE id = ${id}";

        $resultado = self::consultarSQL($consultaPropiedad);

        return array_shift($resultado);
    }

    public static function consultarSQL($query) {
        // Consultar la base de datos
        $resultado = self::$db->query($query);

        // Iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }

        // Liberar la memoria
        $resultado->free();

        // Retornar los resultados
        return $array;
    }

    protected static function crearObjeto($registro) {
        $objeto = new static;

        foreach($registro as $key => $value) {
            if(property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }

    // Sincroniza el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar($args = []) {
        foreach($args as $key => $value) {
            if(property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }

                <!-- <?php foreach ($refugios as $refugio) : ?>
                    <option 
                    <?php echo $perro->Refugio_idRefugio === $refugio->idRefugio ? 'selected' : ''; ?> 
                        value="<?php echo s($refugio->idRefugio); ?>">
                        <?php echo s($refugio->nombre); ?>
                    </option>
                <?php endforeach; ?> -->