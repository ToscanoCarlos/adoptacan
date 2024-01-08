<?php 
    require 'includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion">

        <h2>Perros en Adopción</h2>

        <?php 
            $limite = 10;
            include 'includes/templates/anuncios.php';
        ?>
    </main>

<?php 
    incluirTemplate('footer');
?>