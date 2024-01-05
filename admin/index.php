<?php

    require '../includes/app.php';
    estaAutenticado();

    use App\Perro;
    use App\Refugio;

    // Implementar un método para obtener todos los perros
    $perros = Perro::all();
    $refugios = Refugio::all();

    // Muestra mensaje condicional
    $resultado = $_GET['resultado'] ?? null;

    // Redireccionar al usuario
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['idPerro'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if($id) {
            $propiedad = Perro::find($id);

            $propiedad->eliminar();

        }
    }

    // Incluir template
    incluirTemplate('header');
?>


    <main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>
        <?php if( intval( $resultado) === 1 ): ?>
            <p class="alerta exito">Anuncio Creado Correctamente</p>
        <?php endif; ?>

        <?php if( intval( $resultado) === 2 ): ?>
            <p class="alerta exito">Anuncio Actualizado Correctamente</p>
        <?php endif; ?>

        <?php if( intval( $resultado) === 3 ): ?>
            <p class="alerta exito">Anuncio Eliminado Correctamente</p>
        <?php endif; ?>


        <table class="perro">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody> <!-- Mostrar los resultados -->
                <?php foreach($perros as $perro): ?>
                <tr>
                    <td> <?php echo $perro->idPerro; ?> </td>
                    <td> <?php echo $perro->nombre; ?> </td>
                    <td><img src="/anipat-master/imagenes/<?php echo $perro->imagen; ?>" class="imagen-tabla"></td>
                    <td> <?php echo $perro->raza; ?> </td>
                    <td>
                        <form method="POST"" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $perro->idPerro; ?>">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="/anipat-master/admin/crud/actualizar.php?id=<?php echo $perro->idPerro; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </main>

<?php

    // Cerrar la conexión
    mysqli_close($db);

    incluirTemplate('footer');
?>