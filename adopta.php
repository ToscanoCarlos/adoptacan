<?php 
    require 'includes/app.php';
    incluirTemplate('header', $inicio = true);
?>
    <!-- header_start  -->

    <!-- bradcam_area_start -->
    
    <div class="bradcam_area breadcam_bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="bradcam_text text-center">
                        <h3>Adopta</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- bradcam_area_end -->

    //<?php 
    //$limite = 3;
    //include 'includes/templates/adopciones.php';
    //?>

    <div class="product-container">
    <div class="product-item">
      <img class="product-image" src="https://via.placeholder.com/300" alt="Producto 1">
      <div class="product-details">
        <h2 class="product-title">Producto 1</h2>
        <span class="product-price">$99.99</span>
        <p class="product-description">Descripción breve del producto 1.</p>
        <a href="#" class="product-button">Ver Detalles</a>
      </div>
    </div>
    <div class="product-item">
      <img class="product-image" src="https://via.placeholder.com/300" alt="Producto 2">
      <div class="product-details">
        <h2 class="product-title">Producto 2</h2>
        <span class="product-price">$149.99</span>
        <p class="product-description">Descripción breve del producto 2.</p>
        <a href="#" class="product-button">Ver Detalles</a>
      </div>
    </div>
    <div class="product-item">
      <img class="product-image" src="https://via.placeholder.com/300" alt="Producto 3">
      <div class="product-details">
        <h2 class="product-title">Producto 3</h2>
        <span class="product-price">$199.99</span>
        <p class="product-description">Descripción breve del producto 3.</p>
        <a href="#" class="product-button">Ver Detalles</a>
      </div>
    </div>
    <!-- Agrega más elementos según sea necesario -->
  </div>

   


    
    <!-- footer_start  -->
<?php 
    incluirTemplate('footer');
?>