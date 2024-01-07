<?php 
    // Importar la conexión
    use App\Perro;

    // Implementar un método para obtener todos los perros
    $perros = Perro::all();

    if($_SERVER['SCRIPT_NAME'] === '/anipet-master/adopta.php') {
        $perros = Perro::all();   
    } else {
        $perros = Perro::get(3);
    }
?>

<div class="product-container">
    <?php foreach($perro as $perro): ?>
    <div class="product-item">
      <img loading="lazy" src="/anipet-master/imagenes/<?php echo $perro->imagen; ?>" alt="anuncio">
      <div class="product-details">
        <h2 class="product-title"><?php echo $perro->nombre; ?></h2>
        <span class="product-price"><?php echo $perro->edad; ?></span>
        <p class="product-description"><?php echo $perro->raza; ?></p>
        <p class="product-description"><?php echo $perro->genero; ?></p>
        <a href="anuncio.php?idPerro=<?php echo $perro->idPerro; ?>" class="product-button">Ver Perro</a>
      </div>
      <?php endforeach; ?>

</div>
    