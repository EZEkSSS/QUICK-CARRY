<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recorridos</title>
    <link rel="stylesheet" href="style.css">
</head>
<header>

    <div class="logo">
        <a href="index.php"><img src="qc.png" alt="qc"></a>
        <h1>Quick Carry</h1>
    </div>
</header>

<body>
    <?php $ci = isset($_GET['ci']) ? $_GET['ci'] : '';?>

    <?php
    $conexion = new mysqli("localhost", "root", "", "quickcarry");
 
    // Obtener todos los paquetes
    $consulta = "SELECT recorrido.id_recorrido, recorrido.matricula FROM recorrido LEFT JOIN conduce ON conduce.matricula = recorrido.matricula WHERE conduce.ci_camionero = $ci AND recorrido.fecha_llegada IS NULL AND conduce.fecha_fin IS NULL;";
    $resultados = $conexion->query($consulta);
    ?>


        <div class="tablaDiv">
            <table border="1">
                <thead>
                    <tr>
                        <th>Id del recorrido</th>
                        <th>Matricula del camion</th>
                        <th>Mas detalles</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($fila = $resultados->fetch_assoc()) {
                        $id_recorrido = $fila["id_recorrido"];
                        $matricula = $fila["matricula"];
                        echo "<tr>";
                        echo "<td>$id_recorrido</td>";
                        echo "<td>$matricula</td>";
                        echo "<td><form action='verMasRecorrido.php' method='get'><input type='hidden' name='ci' value='$ci'><input type='hidden' name='id_recorrido' value='$id_recorrido'><button type='submit' name='verMas' id='verMas'>Ver mas</button></form></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

    <div class="volver">
        <input type="button" value="Volver" onclick="window.location.href='index.php?ci=<?php echo $ci ?>'">
    </div>

</body>

</html>