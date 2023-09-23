<?php
$CI = $_POST['CI'];
$contraseña = $_POST['contraseña'];

$datos = array(
    'CI' => $CI,
    'contraseña' => $contraseña
);

$jsonData = json_encode($datos);

$ch = curl_init();
$url = "http://localhost/QUICK%20CARRY/API%20AUTENTICACION/Modelo/autenticacion.php"; // Ruta al archivo autenticacion.php

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

$result = json_decode($response, true);

if ($result['exito']) {
    $CI = $result['CI'];
    
    // Consulta para obtener el cargo del usuario
    $conexion = new mysqli("localhost", "root", "", "quickcarry");
    $query = "SELECT cargo FROM persona WHERE CI = '$CI'";
    $resultado = $conexion->query($query);

    if ($resultado) {
        $fila = $resultado->fetch_assoc();
        $cargo = $fila['cargo'];

        switch ($cargo) {
            case "Admin":
                header("Location: /QUICK CARRY/crud/index.php?exito=true");
                break;
            case "Camionero":
                header("Location: /QUICK CARRY/Camionero/index.php?exito=true&ci=$CI");
                break;
            case "Funcionario Almacen":
                // Consulta para obtener el almacén en el que trabaja el usuario
                $queryAlmacen = "SELECT ALMACEN.departamento
                                FROM PERSONA
                                INNER JOIN FUNCIONARIO_ALMACEN ON PERSONA.CI = FUNCIONARIO_ALMACEN.CI
                                INNER JOIN ALMACEN ON FUNCIONARIO_ALMACEN.id_almacen = ALMACEN.id_almacen
                                WHERE PERSONA.CI = '$CI'";
                $resultadoAlmacen = $conexion->query($queryAlmacen);
                
                if ($resultadoAlmacen) {
                    $filaAlmacen = $resultadoAlmacen->fetch_assoc();
                    $almacen = $filaAlmacen['departamento'];
                    header("Location: /QUICK CARRY/Almacen/index.php?exito=true&almacen=$almacen");
                } else {
                    echo "Error en la consulta SQL para obtener el almacén: " . $conexion->error;
                }
                break;
            default:
                echo "Cargo desconocido.";
        }
    } else {
        echo "Error en la consulta SQL: " . $conexion->error;
    }
} else {
    echo $result['mensaje'];
}
?>
