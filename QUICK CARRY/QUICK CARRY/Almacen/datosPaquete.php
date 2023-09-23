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
    <title>Datos paquetes</title>
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


    <h1>Informacion Paquetes - <?php echo $almacen; ?></h1>

    <?php
    $conexion = new mysqli("localhost", "root", "", "quickcarry");
    $mensaje = '';

    // Obtener todos los paquetes

    if ($almacen === "Montevideo") {
        $consulta = "SELECT id_paquete, nombre_destinatario, email_destinatario, departamento_destinatario, ciudad_destinatario, calle_destinatario, numero_puerta_destinatario
        FROM paquete WHERE estado = 'Ingresado almacen' ";
        $resultados = $conexion->query($consulta);
    } else {
        $consulta = "SELECT id_paquete, nombre_destinatario, email_destinatario, departamento_destinatario, ciudad_destinatario, calle_destinatario, numero_puerta_destinatario
        FROM paquete WHERE departamento_destinatario = '$almacen' AND estado = 'Entregado en almacen'";
        $resultados = $conexion->query($consulta);
    }
    ?>


    <div class="tablaDiv">
        <table border="1">
            <thead>
                <tr>
                    <th>Id</th>

                    <th>Nombre Destinatario</th>
                    <th>Mail Destinatario</th>
                    <th>Departamento Destinatario</th>
                    <th>Ciudad Destinatario</th>
                    <th>Calle Destinatario</th>
                    <th>Numero Puerta Destinatario</th>
                    <th>Acción</th>
                    <th>Mas info</th>


                </tr>
            </thead>
            <tbody>
                <?php
                while ($fila = $resultados->fetch_assoc()) {
                    $id = $fila["id_paquete"];
                    $nombreDestinatario = $fila["nombre_destinatario"];
                    $mailDestinatario = $fila["email_destinatario"];
                    $departamentoDestinatario = $fila["departamento_destinatario"];
                    $ciudadDestinatario = $fila["ciudad_destinatario"];
                    $calleDestinatario = $fila["calle_destinatario"];
                    $numeroPuertaDestinatario = $fila["numero_puerta_destinatario"];

                    echo "<tr>";
                    echo "<td>$id</td>";
                    echo "<td>$nombreDestinatario</td>";
                    echo "<td>$mailDestinatario</td>";
                    echo "<td>$departamentoDestinatario</td>";
                    echo "<td>$ciudadDestinatario</td>";
                    echo "<td>$calleDestinatario</td>";
                    echo "<td>$numeroPuertaDestinatario</td>";
                    echo "<td><form action='modificarPaqueteNuevo.php' method='get'>
                        <input type='hidden' name='id' value='$id'>
                        <input type='hidden' name='almacen' value='$almacen'>
                        <button type='submit' name='modificar'>Modificar</button></form></td>";

                    echo "<td><form action='todosDatosPaquete.php' method='get'>
                        <input type='hidden' name='id' value='$id'>
                        <input type='hidden' name='almacen' value='$almacen'>
                        <button type='submit' name='modificar'>mas Info</button></form></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="volver">
        <input type="button" value="Volver" onclick="window.location.href='index.php?almacen=<?php echo $almacen; ?>'">
    </div>
    <p><?php echo $mensaje; ?></p>
    <script src="script.js"></script>
</body>

</html>