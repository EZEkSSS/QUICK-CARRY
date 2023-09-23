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
    <title>LOTES</title>
</head>
<header>

    <div class="logo">
        <a href="index.php"><img src="qc.png" alt="qc"></a>
        <h1>Quick Carry</h1>
    </div>

    <input type="checkbox" id="menu-toggle" class="menu-toggle">
    <label for="menu-toggle" class="menu-btn">
        <span></span>
        <span></span>
        <span></span>
    </label>
    <ul class="menu">
        <li><a href="controlUsuarios.php">Control de usuarios</a></li>
        <li><a href="controlCamiones.php">Control de camiones</a></li>
        <li><a href="controlAlmacenes.php">Control de almacenes</a></li>
    </ul>

</header>

<body>

    <h1>Gestion de Recorridos - <?php echo $almacen; ?></h1>


    <?php
    $conexion = new mysqli("localhost", "root", "", "quickcarry");

    // Obtener todos los recorridos
    $consulta = "SELECT R.id_recorrido, R.matricula AS matricula_camion, PP.id_almacen, A.departamento AS departamento_almacen 
    FROM RECORRIDO R 
    INNER JOIN PASA_POR PP ON R.id_recorrido = PP.id_recorrido 
    INNER JOIN ALMACEN A ON PP.id_almacen = A.id_almacen;";
    $resultados = $conexion->query($consulta);


    if (!$resultados) {
        die("Error en la consulta: " . $conexion->error);
    }
    ?>
    <div class="tablas">
    
        <div class="tablaDivLot">

            <table border="1">
                <thead>
                    <tr>
                        <th>Id Recorridos</th>
                        <th>Destino Recorridos</th>
                        <th>Vehiculo</th>
                        <th>Modificar </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($fila = $resultados->fetch_assoc()) {
                        $id_recorrido = $fila["id_recorrido"];
                        $departamento_almacen = $fila["departamento_almacen"];
                        $matricula = $fila["matricula_camion"];

                        echo "<tr>";
                        echo "<td>" . $id_recorrido . "</td>";
                        echo "<td>" . $departamento_almacen . "</td>";
                        echo "<td>" . $matricula . "</td>";
                        echo "<td><form action='modificarRecorridos.php' method='get'>
                        <input type='hidden' name='id' value='$id_recorrido'>
                        <input type='hidden' name='almacen' value='$almacen'>
                        <button class='boton-modificar'>Modificar</button>
                        </form>
                        </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="volver">


        <input type="button" value="Volver" onclick="window.location.href='index.php?almacen=<?php echo $almacen; ?>'">
    </div>
    <script src="script.js"></script>
</body>

</html>