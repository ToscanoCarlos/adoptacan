<?php 
    
    require 'includes/app.php';

    use App\Perro;

    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id) {
        header('Location: /anipat-master/index.php');
    }

    $perro = Perro::find($id);

    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1><?php echo $perro->titulo; ?></h1>

     
        <img loading="lazy" src="/anipat-master/imagenes/<?php echo $perro->imagen; ?>" alt="imagen de la perro">

        <div class="resumen-perro">
            <p class="precio">$<?php echo $perro->precio; ?></p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                    <p><?php echo $perro->wc; ?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                    <p><?php echo $perro->estacionamiento; ?></p>
                </li>
                <li>
                    <img class="icono"  loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                    <p><?php echo $perro->habitaciones; ?></p>
                </li>
            </ul>

            <?php echo $perro->descripcion; ?>
        </div>
    </main>

<?php 

    incluirTemplate('footer');
?>