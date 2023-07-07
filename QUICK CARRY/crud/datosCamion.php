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
    $consulta = "SELECT matricula, marca, modelo, tipo, capacidad_carga,estado FROM camiones";
    $resultados = $conexion->query($consulta);
    ?>


    <div class="tablaDiv">

        <table border="1">
            <thead>
                <tr>
                    <th>Matricula</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Tipo</th>
                    <th>capacidad_carga</th>
                    <th>Estado</th>
                


                </tr>
            </thead>
            <tbody>
                <?php
                while ($fila = $resultados->fetch_assoc()) {
                    $matricula = $fila["matricula"];
                    $marca = $fila["marca"];
                    $modelo = $fila["modelo"];
                    $tipo = $fila["tipo"];
                    $capacidad_carga = $fila["capacidad_carga"];
                    $estado = $fila["estado"];



                    echo "<tr>";
                    echo "<td>$matricula</td>";
                    echo "<td>$marca</td>";
                    echo "<td>$modelo</td>";
                    echo "<td>$tipo</td>";
                    echo "<td>$capacidad_carga</td>";
                    echo "<td>$estado</td>";

                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="volver">
        <input type="button" value="Volver" onclick="window.location.href='controlCamiones.php'">
    </div>
    <script src="script.js"></script>
</body>

</html>