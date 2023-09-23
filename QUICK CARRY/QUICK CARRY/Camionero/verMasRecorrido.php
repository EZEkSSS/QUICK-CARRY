<?php
// Establece la conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "quickcarry");

// Verifica si se recibió el parámetro ci en la URL
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["ci"]) && isset($_GET["id_recorrido"]) && isset($_GET["id_almacen"])) {
    $ci = $_GET['ci'];
    $id_recorrido = $_GET["id_recorrido"];
    $id_almacen = $_GET["id_almacen"];

    // Obtener la fecha y hora actual
    $fecha_actual = date("Y-m-d");
    $hora_actual = date("H:i:s");

    // Actualizar el estado de los lotes que iban a ese almacén en ese recorrido a 'Entregado'
    $actualizar_lotes = "UPDATE LOTE
    SET estado = 'Entregado' WHERE id_recorrido = $id_recorrido
    AND departamento_destino = (
        SELECT departamento
        FROM ALMACEN
        WHERE id_almacen = $id_almacen
    );
    ";
    $conexion->query($actualizar_lotes);

    // Actualizar la fecha, hora y estado de los paquetes que tenían la ID de esos lotes
    $actualizar_paquetes = "UPDATE PAQUETE
    SET estado = 'Entregado en almacen', fecha_entrega = '$fecha_actual', hora_entrega = '$hora_actual'
    WHERE id_lote IN (
        SELECT id_lote
        FROM LOTE
        WHERE estado = 'Entregado'
    );
    ";
    $conexion->query($actualizar_paquetes);

    // Actualizar el estado de la tabla PASA_POR del almacén de ese recorrido a 'Entregado'
    $actualizar_pasa_por = "UPDATE PASA_POR SET estado = 'Entregado' WHERE id_recorrido = $id_recorrido AND id_almacen = $id_almacen";
    $conexion->query($actualizar_pasa_por);

    // Verificar si todos los almacenes del recorrido tienen el estado 'Entregado'
    $consulta_verificar_entregados = "SELECT COUNT(*) AS total FROM PASA_POR WHERE id_recorrido = $id_recorrido AND estado IS NULL";
    $resultado_verificar = $conexion->query($consulta_verificar_entregados);
    $fila_verificar = $resultado_verificar->fetch_assoc();
    $total_almacenes = $fila_verificar['total'];

    if ($total_almacenes == 0) {
        // Todos los almacenes tienen estado 'Entregado', actualiza el recorrido y CONDUCE
        $actualizar_recorrido = "UPDATE RECORRIDO
        SET fecha_llegada = '$fecha_actual', hora_llegada = '$hora_actual'
        WHERE id_recorrido = $id_recorrido;
    
        UPDATE CONDUCE
        SET fecha_fin = '$fecha_actual'
        WHERE ci_camionero = '$ci' AND matricula IN (SELECT matricula FROM RECORRIDO WHERE id_recorrido = $id_recorrido)";

        $consulta_matricula = "SELECT matricula FROM RECORRIDO WHERE id_recorrido = $id_recorrido";
        $resultado_matricula = $conexion->query($consulta_matricula);

        if ($resultado_matricula->num_rows > 0) {
            $fila_matricula = $resultado_matricula->fetch_assoc();
            $matricula = $fila_matricula["matricula"];

            // Actualizar el estado del vehículo a 'Disponible'
            $actualizar_estado_vehiculo = "UPDATE VEHICULO
                                           SET estado = 'Disponible'
                                           WHERE matricula = '$matricula'";

            $conexion->query($actualizar_estado_vehiculo);
        }

        $conexion->multi_query($actualizar_recorrido);
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mas detalles recorrido</title>
    <link rel="stylesheet" href="style.css">
</head>
<header>

    <div class="logo">
        <a href="index.php"><img src="qc.png" alt="qc"></a>
        <h1>Quick Carry</h1>
    </div>
</header>

<body>
    <?php
    // Establece la conexión a la base de datos nuevamente (puedes optimizar esto)
    $conexion = new mysqli("localhost", "root", "", "quickcarry");

    // Verifica si se recibió el parámetro ci en la URL
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["ci"]) && isset($_GET["id_recorrido"])) {
        $ci = $_GET['ci'];
        $id_recorrido = $_GET["id_recorrido"];

        // Realiza una consulta SQL para obtener información de almacenes asociados a un recorrido que los lotes no han sido entregados
        $consulta = "SELECT ALMACEN.id_almacen, ALMACEN.departamento
                     FROM ALMACEN
                     INNER JOIN PASA_POR ON ALMACEN.id_almacen = PASA_POR.id_almacen
                     WHERE PASA_POR.id_recorrido = $id_recorrido AND pasa_por.estado IS NULL";
        $resultados = $conexion->query($consulta);
    }
    ?>

    <h1>Almacenes del recorrido
        <?php echo $id_recorrido ?>
    </h1>

    <div class="tablaDiv">
        <table border="1">
            <thead>
                <tr>
                    <th>ID del Almacén</th>
                    <th>Departamento del Almacén</th>
                    <th>Entregar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Recorre los resultados de la consulta y muestra cada almacén
                while ($fila = $resultados->fetch_assoc()) {
                    $idAlmacen = $fila["id_almacen"];
                    $departamentoAlmacen = $fila["departamento"];

                    echo "<tr>";
                    echo "<td>$idAlmacen</td>";
                    echo "<td>$departamentoAlmacen</td>";
                    echo "<td><form action='' method='get'><input type='hidden' name='ci' value='$ci'><input type='hidden' name='id_recorrido' value='$id_recorrido'><input type='hidden' name='id_almacen' value='$idAlmacen'> <input type='submit' id='entregar' value='Entregar' onclick='return confirm(\"¿Seguro que desea realizar esta acción?\");'></form></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="volver">
        <input type="button" value="Volver" onclick="window.location.href='recorridos.php?ci=<?php echo $ci ?>'">
    </div>

    <script src="script.js"></script>
</body>

</html>