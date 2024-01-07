<?php

    require '../includes/app.php';
    //estaAutenticado();

    // Importar la conexión
    use App\Perro;
    use App\Refugio;

    // Implementar un método para obtener todos los perros
    $perros = Perro::all();
    $refugios = Refugio::all();

    // Muestra mensaje condicional
    $resultado = $_GET['resultado'] ?? null;

    // Redireccionar al usuario
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Compara lo que vamos a eliminar
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if($id) {

            $tipo = $_POST['tipo'];

            if (validarTipoContenido($tipo)) {
                // Compara lo que vamos a eliminar
                if($tipo === 'perro') {
                    $perro = Perro::find($id);
                    $perro->eliminar();
                } else if ($tipo === 'refugio') {
                    $refugio = Refugio::find($id);
                    $refugio->eliminar();
                }
            }
        }
    }

    // Incluir template
    incluirTemplate('header');
?>


    <main class="product-container">
        <h1 class="section_title3">Administrador de AdoptaCan</h1>
        <?php 
            $mensaje = mostrarNotificacion(intval($resultado));
            if($mensaje) { ?>
                <p class="alerta exito"><?php echo s($mensaje); ?></p>
            <?php } ?>   
        <a href="/add.php" class="boxed-btn3">Nuevo Perro</a>
        <a href="/admin/refugios/crear.php"class="boxed-btn3">Nuevo Refugio</a>


        <h2>Perros</h2>
        <table class="product-container perros">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Imagen</th>
                    <th>Raza</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody> <!-- Mostrar los resultados -->
                <?php foreach($perros as $perro): ?>
                <tr>
                    <td> <?php echo $perro->idPerro; ?> </td>
                    <td> <?php echo $perro->nombre; ?> </td>
                    <td><img src="/imagenes/<?php echo $perro->imagen; ?>" class="imagen-tabla"></td>
                    <td> <?php echo $perro->raza; ?> </td>
                    <td>
                        <form method="POST"" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $perro->idPerro; ?>">
                            <input type="hidden" name="tipo" value="perro">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="/admin/crud/actualizar.php?id=<?php echo $perro->idPerro; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>Refugios</h2>
        <table class="product-container refugios">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody> <!-- Mostrar los resultados -->
                <?php foreach($refugios as $refugio): ?>
                <tr>
                    <td> <?php echo $refugio->idRefugio; ?> </td>
                    <td> <?php echo $refugio->nombre; ?> </td>
                    <td> <?php echo $refugio->telefono; ?> </td>
                    <td>
                        <form method="POST"" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $refugio->idRefugio; ?>">
                            <input type="hidden" name="tipo" value="refugio">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="/admin/refugios/actualizar.php?id=<?php echo $refugio->idRefugio; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        

    </main>

<?php
    incluirTemplate('footer');
?>