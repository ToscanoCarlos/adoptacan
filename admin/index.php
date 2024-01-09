<?php

    require '../includes/funciones.php';
    $auth = estaAutenticado();

    if(!$auth){
        header('Location: /adoptacan/index.php');
    }

    // Importar la conexión
    require '../includes/config/database.php';
    $db = conectarDB();

    // Escribir el Query
    $query = "SELECT * FROM perro";
    $query2 = "SELECT * FROM adoptantes";
    $query3 = "SELECT * FROM refugio";

    // Consultar la DB
    $resultadoConsulta = mysqli_query($db, $query);
    $resultadoConsulta2 = mysqli_query($db, $query2);
    $resultadoConsulta3 = mysqli_query($db, $query3);

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

            // Eliminar adoptante
            $query2 = "DELETE FROM adoptantes WHERE id = ${id}";
            $resultado = mysqli_query($db, $query2);

            // Eliminar refugio
            $query = "DELETE FROM refugio WHERE idRefugio = ${id}";
            $resultado = mysqli_query($db, $query);

            if($resultado) {
                header('Location: /adoptacan/admin/index.php?resultado=3');
            }
        }
    }

    // Incluir template
    incluirTemplate('header');
?>

<h1 class="section_title3">Administrador de AdoptaCan</h1>

<br>
        <?php if( intval( $resultado) === 1 ): ?>
            <p class="alerta exito">Creado Correctamente</p>
        <?php endif; ?>
        <?php if( intval( $resultado) === 2 ): ?>
            <p class="alerta exito">Actualizado Correctamente</p>
        <?php endif; ?>

        <?php if( intval( $resultado) === 3 ): ?>
            <p class="alerta exito">Eliminado Correctamente</p>
        <?php endif; ?> 

    <main class="product-container">
        
        

        <a href="/adoptacan/admin/crud/crear.php" class="boxed-btn3">Nuevo Perro</a>
        <br>



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
                        <a href="/adoptacan/admin/crud/actualizar.php?id=<?php echo $perro['idPerro']; ?>" class="boton-amarillo-block2">Actualizar</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <h2>Solicitudes de Adopción</h2>
        <table class="perros">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody> <!-- Mostrar los resultados -->
                <?php while($adoptante = mysqli_fetch_assoc($resultadoConsulta2) ): ?>
                <tr>
                    <td> <?php echo $adoptante['id']; ?> </td>
                    <td> <?php echo $adoptante['nombre']; ?> </td>
                    <td> <?php echo $adoptante['apellido']; ?> </td>
                    <td> <?php echo $adoptante['email']; ?></td>
                    <td>
                        <form method="POST"" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $adoptante['id']; ?>">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <a href="/adoptacan/admin/refugios/crear.php" class="boxed-btn3">Nuevo Refugio</a>
        <br>



        <h2>Refugio</h2>
        <table class="perros">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Telefóno</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody> <!-- Mostrar los resultados -->
                <?php while($refugio = mysqli_fetch_assoc($resultadoConsulta3) ): ?>
                <tr>
                    <td> <?php echo $refugio['idRefugio']; ?> </td>
                    <td> <?php echo $refugio['nombre']; ?> </td>
                    <td> <?php echo $refugio['email']; ?> </td>
                    <td> <?php echo $refugio['telefono']; ?> </td>
                    <td>
                        <form method="POST"" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $refugio['idRefugio']; ?>">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="/adoptacan/admin/refugios/actualizar.php?id=<?php echo $refugio['idRefugio']; ?>" class="boton-amarillo-block2">Actualizar</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>



    </main>

<?php
    incluirTemplate('footer');
?>