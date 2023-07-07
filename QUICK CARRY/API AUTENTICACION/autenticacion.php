<?php
// Obtiene los datos JSON enviados desde controladorAutenticacion.php
$jsonData = file_get_contents('php://input');
$datos = json_decode($jsonData, true);

$email = $datos['email'];
$contrasena = $datos['contrasena'];

$conexion = new mysqli("localhost", "root", "", "usuarios");

// Verifica si el usuario existe en la base de datos
$sql = "SELECT * FROM personas WHERE email = '$email'";
$result = $conexion->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $ps = $row['contrasena'];
    $cargo = $row['cargo'];

    if ($ps == $contrasena) {
        $response = array('exito' => true, 'cargo' => $cargo);
    } else {
        $response = array('exito' => false, 'mensaje' => 'Contraseña incorrecta.');
    }
} else {
    $response = array('exito' => false, 'mensaje' => 'El usuario no existe en la base de datos.');
}

echo json_encode($response);
?>
