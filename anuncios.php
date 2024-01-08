<?php 
    require 'includes/funciones.php';
    incluirTemplate('header');
?>

    <main>

        <h2 class="centro-al-area">Perros en Adopción</h2>

        <?php 
            $limite = 10;
            include 'includes/templates/anuncios.php';
        ?>
    </main>

<?php 
    incluirTemplate('footer');
?>