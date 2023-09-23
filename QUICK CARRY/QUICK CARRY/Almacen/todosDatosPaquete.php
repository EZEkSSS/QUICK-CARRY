<?php
$almacen = isset($_GET['almacen']) ? $_GET['almacen'] : '';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="qc.png">
    <title> Mas Datos Paquete</title>
</head>
<header>

    <div class="logo">
        <a href="index.php?almacen=<?php echo $almacen; ?>"><img src="qc.png" alt="qc"></a>

        <h1>Quick Carry</h1>
    </div>


    <input type="checkbox" id="menu-toggle" class="menu-toggle">
    <label for="menu-toggle" class="menu-btn">
        <span></span>
        <span></span>
        <span></span>

    </label>
    <ul class="menu">
        <?php

        if ($almacen === "Montevideo") {
        ?>
            <li><a href="altaPaquete.php?almacen=<?php echo $almacen; ?>">Alta de Paquetes</a></li>
            <li><a href="gestionLotes.php?almacen=<?php echo $almacen; ?>">Gestión de Lotes</a></li>
            <li><a href="gestionRecorridos.php?almacen=<?php echo $almacen; ?>">Gestión de Recorridos</a></li>

        <?php
        }
        ?>

        <li><a href="datosPaquete.php?almacen=<?php echo $almacen; ?>">Ver paquetes</a></li>


    </ul>

</header>

<body>



    <?php
    $conexion = new mysqli("localhost", "root", "", "quickcarry");
    $mensaje = '';

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"]) && isset($_GET["almacen"])) {
        $id = $_GET["id"];
        $almacen = $_GET["almacen"];

        // Obtener todos los paquetes
        $consulta = "SELECT `id_paquete`, `id_lote`, `matricula`, `peso`, `tamaño`, `tipo_entrega`, `fecha_ingreso`, `hora_ingreso`, `fecha_envio`, `hora_envio`, `fecha_entrega`, `hora_entrega`, `departamento_destinatario`, `ciudad_destinatario`, `calle_destinatario`, `numero_puerta_destinatario`, `nombre_destinatario`, `email_destinatario`, `estado`
     FROM `paquete` 
     WHERE id_paquete = $id;";
        $resultados = $conexion->query($consulta);
    }
    ?>

    <h1>Informacion del Paquete <?php echo $id; ?></h1>

    <div class="tablaDiv">
        <table border="1">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Peso</th>
                    <th>Tamaño</th>
                    <th>Tipo Entrga</th>

                    <th>fecha_ingreso</th>
                    <th>hora_ingreso</th>
                    <th>fecha_envio</th>
                    <th>hora_envio</th>
                    <th>fecha_entrega</th>
                    <th>hora_entrega</th>

                    <th>Nombre Destinatario</th>
                    <th>Mail Destinatario</th>
                    <th>Departamento Destinatario</th>
                    <th>Ciudad Destinatario</th>
                    <th>Calle Destinatario</th>
                    <th>Numero Puerta Destinatario</th>



                </tr>
            </thead>
            <tbody>
                <?php
                while ($fila = $resultados->fetch_assoc()) {
                    $id = $fila["id_paquete"];
                    $peso = $fila["peso"];
                    $tamaño = $fila["tamaño"];
                    $tipo_entrega = $fila["tipo_entrega"];

                    $fecha_ingreso = $fila["fecha_ingreso"];
                    $hora_ingreso = $fila["hora_ingreso"];
                    $fecha_envio = $fila["fecha_envio"];
                    $hora_envio = $fila["hora_envio"];
                    $fecha_entrega = $fila["fecha_entrega"];
                    $hora_entrega = $fila["hora_entrega"];

                    $nombreDestinatario = $fila["nombre_destinatario"];
                    $mailDestinatario = $fila["email_destinatario"];
                    $departamentoDestinatario = $fila["departamento_destinatario"];
                    $ciudadDestinatario = $fila["ciudad_destinatario"];
                    $calleDestinatario = $fila["calle_destinatario"];
                    $numeroPuertaDestinatario = $fila["numero_puerta_destinatario"];

                    echo "<tr>";
                    echo "<td>$id</td>";
                    echo "<td>$peso</td>";
                    echo "<td>$tamaño</td>";
                    echo "<td>$tipo_entrega</td>";

                    echo "<td>$fecha_ingreso</td>";
                    echo "<td>$hora_ingreso</td>";
                    echo "<td>$fecha_envio</td>";
                    echo "<td>$hora_envio</td>";
                    echo "<td>$fecha_entrega</td>";
                    echo "<td>$hora_entrega</td>";

                    echo "<td>$nombreDestinatario</td>";
                    echo "<td>$mailDestinatario</td>";
                    echo "<td>$departamentoDestinatario</td>";
                    echo "<td>$ciudadDestinatario</td>";
                    echo "<td>$calleDestinatario</td>";
                    echo "<td>$numeroPuertaDestinatario</td>";

                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="volver">
        <input type="button" value="Volver" onclick="window.location.href='datosPaquete.php?almacen=<?php echo $almacen; ?>'">
    </div>
    <p><?php echo $mensaje; ?></p>
    <script src="script.js"></script>
</body>

</html>