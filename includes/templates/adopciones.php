<?php 
    // Importar la conexión
    require __DIR__ . '/../config/database.php';
    $db = conectarDB();


    // consultar
    $query = "SELECT * FROM perro LIMIT ${limite}";

    // obtener resultado
    $resultado = mysqli_query($db, $query);


?>
<?php 
    // Importar la conexión
    require __DIR__ . '/../config/database.php';
    $db = conectarDB();


    // consultar
    $query = "SELECT * FROM perro LIMIT ${limite}";

    // obtener resultado
    $resultado = mysqli_query($db, $query);


?>

<div class="product-container">
    <?php while($perro = mysqli_fetch_assoc($resultado)): ?>
    <div class="product-item">
      <img loading="lazy" src="/anipet-master/imagenes/<?php echo $perro['imagen']; ?>" alt="anuncio">
      <div class="product-details">
        <h2 class="product-title"><?php echo $perro['nombre']; ?></h2>
        <span class="product-price"><?php echo $perro['edad']; ?></span>
        <p class="product-description"><?php echo $perro['raza']; ?></p>
        <p class="product-description"><?php echo $perro['genero']; ?></p>
        <a href="anuncio.php?idPerro=<?php echo $perro['idPerro']; ?>" class="product-button">Ver Perro</a>
      </div>
      <?php endwhile; ?>

</div>
    

<?php 

    // Cerrar la conexión
    mysqli_close($db);
?>
