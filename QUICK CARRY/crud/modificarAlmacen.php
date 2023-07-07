<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="qc.png">
    <title>Modificar Almacenes</title>
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
    <h1>Modificar almacenes</h1>

    <?php
    $conexion = new mysqli("localhost", "root", "", "usuarios");
    $mensaje = '';

    // Actualizar datos del almacen seleccionado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST["almacen"];
        $departamento = $_POST["departamento$id"];
        $ciudad = $_POST["ciudad$id"];
        $calle = $_POST["calle$id"];
        $numero_puerta = $_POST["numero_puerta$id"];
        $capacidad = $_POST["capacidad$id"];

        $sentencia = "UPDATE almacenes SET departamento = '$departamento', ciudad = '$ciudad', calle = '$calle', numero_puerta = '$numero_puerta', capacidad = '$capacidad' WHERE id = $id";

        if ($conexion->query($sentencia) === TRUE) {
            $mensaje = "Almacen modificado exitosamente";
        } else {
            $mensaje = "Error al modificar el almacen: " . $conexion->error;
        }
    }

    // Obtener todos los camiones
    $consulta = "SELECT id, departamento, ciudad, calle, numero_puerta, capacidad FROM almacenes";
    $resultados = $conexion->query($consulta);
    ?>

    <form action="" method="post">
        <div class="tablaDiv">
            <table border="1">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Departamento</th>
                        <th>Ciudad</th>
                        <th>Calle</th>
                        <th>numero_puerta</th>
                        <th>capacidad</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($fila = $resultados->fetch_assoc()) {
                        $id = $fila["id"];
                        $departamento = $fila["departamento"];
                        $ciudad = $fila["ciudad"];
                        $calle = $fila["calle"];
                        $numero_puerta = $fila["numero_puerta"];
                        $capacidad = $fila["capacidad"];

                        echo "<tr>";
                        echo "<td>$id</td>";
                        echo "<td><input type='text' name='departamento$id' value='$departamento'></td>";
                        echo "<td><input type='text' name='ciudad$id' value='$ciudad'></td>";
                        echo "<td><input type='text' name='calle$id' value='$calle'></td>";
                        echo "<td><input type='text' name='numero_puerta$id' value='$numero_puerta'></td>";
                        echo "<td><input type='text' name='capacidad$id' value='$capacidad'></td>";
                        echo "<td><button type='submit' name='camion' value='$id'>Guardar</button></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </form>
    <div class="volver">
        <input type="button" value="Volver" onclick="window.location.href='controlAlmacenes.php'">
    </div>
    <p><?php echo $mensaje; ?></p>
    <script src="script.js"></script>
</body>

</html>