<?php 

    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id) {
        header('Location: /adoptacan/index.php');
    }

    // Importar la conexión
    require 'includes/config/database.php';
    $db = conectarDB();


    // consultar
    $query = "SELECT * FROM perro WHERE idPerro = ${id}";
    

    // obtener resultado
    $resultado = mysqli_query($db, $query);


    if(!$resultado->num_rows) {
        header('Location: /adoptacan/index.php');
    } 
    
    $perro = mysqli_fetch_assoc($resultado);


    require 'includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1><?php echo $perro['nombre']; ?></h1>

     
        <img loading="lazy" src="/adoptacan/imagenes/<?php echo $perro['imagen']; ?>" alt="Imagen del perro">

        <div class="resumen-perro">
            <p class="precio"><?php echo $perro['edad']; ?></p>
            <ul class="iconos-caracteristicas">
                <li>
                    <p><?php echo $perro['edad']; ?></p>
                </li>
                <li>
                    
                    <p><?php echo $perro['genero']; ?></p>
                </li>
                <li>
                   
                    <p><?php echo $perro['extra']; ?></p>
                </li>
            </ul>

            <?php echo $perro['descripcion']; ?>

            <a href="/adoptacan/correo.php?id=<?php echo $perro['idPerro']; ?>" class="boton-amarillo-block">Adoptar</a>
        </div>
    </main>

<?php 
    mysqli_close($db);

    incluirTemplate('footer');
?>