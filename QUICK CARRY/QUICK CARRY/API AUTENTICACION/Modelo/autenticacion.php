<?php
// Obtiene los datos JSON enviados desde controladorAutenticacion.php
$jsonData = file_get_contents('php://input');
$datos = json_decode($jsonData, true);

$CI = $datos['CI'];
$contraseña = $datos['contraseña'];

$conexion = new mysqli("localhost", "root", "", "quickcarry");

// Verifica si el usuario existe en la base de datos
$sql = "SELECT * FROM usuario WHERE CI = '$CI'";
$result = $conexion->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $ps = $row['contraseña'];

    if ($ps == $contraseña) {

/*MANDA LA CEDULA Y EN CONTROL VERIFICA*/        
       $response = array('exito' => true, 'CI' => $CI);

    } else {
        $response = array('exito' => false, 'mensaje' => 'Contraseña incorrecta.');
    }
} else {
    $response = array('exito' => false, 'mensaje' => 'El usuario no existe en la base de datos.');
}

echo json_encode($response);
?>
