<?php

    require '../includes/funciones.php';
    // $auth = estaAutenticado();

    // if(!$auth){
    //     header('Location: /adoptacan');
    // }

    // Importar la conexión
    require '../includes/config/database.php';
    $db = conectarDB();

    // Escribir el Query
    $query = "SELECT * FROM perro";

    // Consultar la DB
    $resultadoConsulta = mysqli_query($db, $query);

    // Muestra mensaje condicional
    $resultado = $_GET['resultado'] ?? null;

    // Redireccionar al usuario
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if($id) {
            // Eliminar el archivo
            $query = "SELECT imagen FROM perro WHERE idPerro = ${id}";
            $resultado = mysqli_query($db, $query);
            $perro = mysqli_fetch_assoc($resultado);


            unlink('../imagenes/' . $perro['imagen']);

            // Eliminar la perro
            $query = "DELETE FROM perro WHERE idPerro = ${id}";
            $resultado = mysqli_query($db, $query);

            if($resultado) {
                header('Location: /adoptacan/admin/index.php?resultado=3');
            }
        }
    }

    // Incluir template
    incluirTemplate('header');
?>



    <main class="product-container">
        <h1 class="section_title3">Administrador de AdoptaCan</h1>
        <?php if( intval( $resultado) === 1 ): ?>
            <p class="alerta exito">Anuncio Creado Correctamente</p>
        <?php endif; ?>
        <?php if( intval( $resultado) === 2 ): ?>
            <p class="alerta exito">Anuncio Actualizado Correctamente</p>
        <?php endif; ?>

        <?php if( intval( $resultado) === 3 ): ?>
            <p class="alerta exito">Anuncio Eliminado Correctamente</p>
        <?php endif; ?> 

        <a href="/adoptacan/admin/crud/crear.php" class="boxed-btn3">Nuevo Perro</a>



        <h2>Perros</h2>
        <table class="perros">
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
                <?php while($perro = mysqli_fetch_assoc($resultadoConsulta) ): ?>
                <tr>
                    <td> <?php echo $perro['idPerro']; ?> </td>
                    <td> <?php echo $perro['nombre']; ?> </td>
                    <td><img src="/adoptacan/imagenes/<?php echo $perro['imagen']; ?>" class="imagen-tabla"></td>
                    <td> <?php echo $perro['raza']; ?> </td>
                    <td>
                        <form method="POST"" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $perro['idPerro']; ?>">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="/adoptacan/admin/crud/actualizar.php?id=<?php echo $perro['idPerro']; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>


    </main>

<?php
    incluirTemplate('footer');
?>