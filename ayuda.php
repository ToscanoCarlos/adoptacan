
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

// if(!$id) {
//     header('Location: /adoptacan/admin/index.php');
// }

//Base de Datos
$db = conectarDB();

// Obtener los datos de la perro
$consultaPerro = "SELECT idPerro,nombre,Refugio_idRefugio FROM perro WHERE idPerro = ${id}";
// $queryPerro = "SELECT idPerro, nombre FROM perro WHERE idPerro = ${id}";
// $queryRefugio = "SELECT nombre FROM refugio WHERE idRefugio = ${id}";
$resultadoPerro = mysqli_query($db, $consultaPerro);
$perro = mysqli_fetch_assoc($resultadoPerro);


$mail = new PHPMailer(true);
$errores = [];

$nombre = '';
$apellido = '';
$edad = '';
$direccion = '';
$ciudad = '';
$codigo_postal = '';
$email = '';
$telefono = '';
$experiencia_mantenimiento_mascotas = '';
$motivo_adopcion = '';
$espacio_disponible = '';
$idPerro = $perro['idPerro'];
$nombrePerro = $perro['nombre'];
$idRefugio = $perro['Refugio_idRefugio'];

$consultaRefugio = "SELECT nombre FROM refugio WHERE idRefugio = $idRefugio";
$resultadoRefugio = mysqli_query($db, $consultaRefugio);
$refugio = mysqli_fetch_assoc($resultadoRefugio);

$refugioNombre = $refugio['nombre'];