<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="qc.png">
    <title>Lista de camiones</title>
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
    <h1>Lista de camiones</h1>

    <?php
    $conexion = new mysqli("localhost", "root", "", "usuarios");

    // Obtener todos los usuarios
    $consulta = "SELECT departamento, ciudad, calle, numero_puerta, capacidad FROM almacenes";
    $resultados = $conexion->query($consulta);
    ?>


    <div class="tablaDiv">

        <table border="1">
            <thead>
                <tr>
                    <th>Departamento</th>
                    <th>Ciudad</th>
                    <th>Calle</th>
                    <th>numero_puerta</th>
                    <th>capacidad</th>

                </tr>
            </thead>
            <tbody>
                <?php
                while ($fila = $resultados->fetch_assoc()) {
                    $departamento = $fila["departamento"];
                    $ciudad = $fila["ciudad"];
                    $calle = $fila["calle"];
                    $numero_puerta = $fila["numero_puerta"];
                    $capacidad = $fila["capacidad"];



                    echo "<tr>";
                    echo "<td>$departamento</td>";
                    echo "<td>$ciudad</td>";
                    echo "<td>$calle</td>";
                    echo "<td>$numero_puerta</td>";
                    echo "<td>$capacidad</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="volver">
        <input type="button" value="Volver" onclick="window.location.href='controlAlmacenes.php'">
    </div>
    <script src="script.js"></script>
</body>

</html>