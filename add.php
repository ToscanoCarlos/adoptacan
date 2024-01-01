<?php 
    require 'includes/app.php';
    incluirTemplate('header', $inicio = true);

    // require '../../includes/app.php';

    // use App\Propiedad;
    // use Intervention\Image\ImageManagerStatic as Image;
    // use App\Vendedor;

    // estaAutenticado();


    // $propiedad = new Propiedad;

    // // Consulta para obtener todos los vendedores
    // $vendedores = Vendedor::all();

    // // Arreglo con mensajes de errores
    // $errores = Propiedad::getErrores();

    // // Ejecutar despues de que el usuario envia el formulario
    // if($_SERVER['REQUEST_METHOD'] === 'POST') {

    //     // Crear una nueva instancia
    //     $propiedad = new Propiedad($_POST['propiedad']);

    //     // Subida de Archivos
    //     // Generar un nombre único
    //     $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";

    //     // Setear la imagen en la propiedad
    //     // Realiza un resize a la imagen con intervention
    //     if($_FILES['propiedad']['tmp_name']['imagen']){
    //         $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
    //         $propiedad->setImagen($nombreImagen);
    //     }
        
    //     // Validar
    //     $errores = $propiedad->validar();

    //     if(empty($errores)) {

    //         // Crear carpeta
    //         if(!is_dir(CARPETA_IMAGENES)) {
    //             mkdir(CARPETA_IMAGENES);
    //         }

    //         // Guardar la imagen
    //         $image->save(CARPETA_IMAGENES . $nombreImagen);

    //         // Guardar en la base de datos
    //         $propiedad->guardar();

    //     }

        
    // }

    // incluirTemplate('header');
?>
    <!-- header_start  -->

    <!-- bradcam_area_start -->
    <div class="bradcam_area breadcam_bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="bradcam_text text-center">
                        <h3>Agregar</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- bradcam_area_end -->

    <!-- ================ contact section start ================= -->
    <section class="contact-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="contact-title">A continuación proporciona los datos</h2>
                </div>
                <div class="col-lg-8">
                    <form class="form-contact contact_form" action="contact_process.php" method="post" id="contactForm" novalidate="novalidate">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <input class="form-control valid" name="nombre" id="nombre" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ingresa el nombre'" placeholder="Nombre">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input class="form-control valid" name="raza" id="raza" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ingresa la raza'" placeholder="Raza">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control valid" name="edad" id="edad" type="number" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ingresa la edad'" placeholder="Edad">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <select class="form-control" name="genero" id="genero">
                                        <option value="" selected>Selecciona el género</option>
                                        <option value="macho">Macho</option>
                                        <option value="hembra">Hembra</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <textarea class="form-control w-100" name="descripcion" id="descripcion" cols="30" rows="6" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ingresa la descripción'" placeholder="Descripción"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input class="form-control" name="extra" id="extra" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ingresa información extra'" placeholder="Información Extra">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <p>Agrega una imagen</p>
                                    <input class="form-control" name="imagen" id="imagen" type="file" accept="image/*">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <p>Seleccione un refugio asociado</p>
                                    <select name="Refugio_idRefugio">
                                        <option value="">-- Seleccione --</option>
                                        <option value="1">Milagros Caninos</option>
                                        <option value="2">San Gregorio</option>
                                        <option value="3">AdoptaCDMX</option>
                                     
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="button button-contactForm boxed-btn">Enviar</button>
                        </div>
                        </form>
                    </div>
                    <div class="col-lg-3 offset-lg-1">
                        <div class="media contact-info">
                            <span class="contact-info__icon"><i class="ti-home"></i></span>
                            <div class="media-body">
                                <h3>Gustavo A. Madero</h3>
                                <p>ESCOM IPN MX</p>
                            </div>
                        </div>
                        <div class="media contact-info">
                            <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                            <div class="media-body">
                                <h3>+55 12341234</h3>
                                <p>Lunes a Viernes 7 A 13 hrs</p>
                            </div>
                        </div>
                        <div class="media contact-info">
                            <span class="contact-info__icon"><i class="ti-email"></i></span>
                            <div class="media-body">
                                <h3>adoptacan@gmail.com</h3>
                                <p>Envia tus comentarios en cualquier momento</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!-- ================ contact section end ================= -->
    
    <!-- footer_start  -->
<?php 
    incluirTemplate('footer');
?>