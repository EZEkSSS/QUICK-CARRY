<?php
$email = $_POST['email'];
$contrasena = $_POST['contrasena'];

$datos = array(
    'email' => $email,
    'contrasena' => $contrasena
);

$jsonData = json_encode($datos);

$ch = curl_init();
$url = "http://localhost/QUICK%20CARRY/API%20AUTENTICACION/autenticacion.php";

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

$result = json_decode($response, true);

if ($result['exito']) {
    $cargo = $result['cargo'];

    switch ($cargo) {
        case "admin":
            header("Location: /QUICK CARRY/crud/index.php?exito=true");
            break;
        case "camionero":
            header("Location: /QUICK CARRY/Camionero/index.html?exito=true");
            break;
        case "personal_almacen":
            header("Location: /QUICK CARRY/Almacen/index.html?exito=true");
            break;
    }
} else {
    echo $result['mensaje'];
}
?>
