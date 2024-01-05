<?php 

    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id) {
        header('Location: /anipet-master/index.php');
    }

    // Importar la conexión
    require 'includes/config/database.php';
    $db = conectarDB();


    // consultar
    $query = "SELECT * FROM perroes WHERE id = ${id}";

    // obtener resultado
    $resultado = mysqli_query($db, $query);

    if(!$resultado->num_rows) {
        header('Location: /anipet-master/index.php');
    } 
    
    $perro = mysqli_fetch_assoc($resultado);


    require 'includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1><?php echo $perro['nombre']; ?></h1>

     
        <img loading="lazy" src="/anipet-master/imagenes/<?php echo $perro['imagen']; ?>" alt="imagen de la perro">

        <div class="resumen-perro">
            <p class="edad">$<?php echo $perro['edad']; ?></p>
            <ul class="iconos-caracteristicas">
                <li>
                    <p><?php echo $perro['genero']; ?></p>
                </li>
                <li>
                    <p><?php echo $perro['raza']; ?></p>
                </li>
                <li>
                    <p><?php echo $perro['extra']; ?></p>
                </li>
            </ul>

            <?php echo $perro['descripcion']; ?>
        </div>
    </main>

<?php 
incluirTemplate('footer');
    mysqli_close($db);
    ?>  