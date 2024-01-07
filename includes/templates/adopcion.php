<?php 
    require 'includes/app.php';

    use App\Perro;

    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id) {
        header('Location: /anipet-master/index.php');
    }

    // Consultar perro
    $perro = Perro::find($id);

    incluirTemplate('header');
?>

<div class="product-container">

    <div class="">
      <img loading="lazy" src="/anipet-master/imagenes/<?php echo $perro->imagen; ?>" alt="anuncio">
      <div class="product-details">
        <h2 class="product-title"><?php echo $perro->nombre; ?></h2>
        <span class="product-price"><?php echo $perro->edad; ?></span>
        <p class="product-description"><?php echo $perro->raza; ?></p>
        <p class="product-description"><?php echo $perro->genero; ?></p>
        <a href="anuncio.php?idPerro=<?php echo $perro->idPerro; ?>" class="product-button">Ver Perro</a>
      </div>


</div>

<?php 
incluirTemplate('footer');
?>  