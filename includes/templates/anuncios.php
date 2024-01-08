<?php
// Importar la conexión
require __DIR__ . '/../config/database.php';
$db = conectarDB();


// consultar
$query = "SELECT * FROM perro LIMIT ${limite}";


// obtener resultado
$resultado = mysqli_query($db, $query);


?>

<div class="contenedor-anuncios">
    <?php while ($perro = mysqli_fetch_assoc($resultado)) : ?>


        <div class="anuncio">

            <img loading="lazy" src="/adoptacan/imagenes/<?php echo $perro['imagen']; ?>" alt="anuncio">

            <div class="contenido-anuncio">
                <h3><?php echo $perro['nombre']; ?></h3>
                <p><?php echo $perro['raza']; ?></p>
                <p class="precio"><?php echo $perro['edad']; ?></p>

                <ul class="iconos-caracteristicas">
                    <li>
                        <p><?php echo $perro['raza']; ?></p>
                    </li>
                    <li>
                        <p><?php echo $perro['genero']; ?></p>
                    </li>
                    <li>
                        <p><?php echo $perro['extra']; ?></p>
                        <!-- <p><?php echo $perro['Refugio_idRefugio']; ?></p> -->
                    </li>
                </ul>

                <a href="anuncio.php?id=<?php echo $perro['idPerro']; ?>" class="boton-amarillo-block">
                    Ver perro
                </a>
            </div><!--.contenido-anuncio-->
        </div><!--anuncio-->
    <?php endwhile; ?>
</div> <!--.contenedor-anuncios-->

<?php

// Cerrar la conexión
mysqli_close($db);
?>