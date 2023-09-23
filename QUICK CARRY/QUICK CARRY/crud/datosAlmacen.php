<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="qc.png">
    <title>Lista de almacenes</title>
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
        <li><a href="controlVehiculos.php">Control de vehiculos</a></li>
        <li><a href="controlAlmacenes.php">Control de almacenes</a></li>
    </ul>

</header>

<body>
    <h1>Lista de almacenes</h1>

    <?php
    $conexion = new mysqli("localhost", "root", "", "quickcarry");

    // Función para eliminar un vehiculo
    function eliminarAlmacen($id_almacen)
    {
        global $conexion;
        $id_almacen = $conexion->real_escape_string($id_almacen);
        $consulta = "DELETE FROM almacen WHERE id_almacen = '$id_almacen'";
        return $conexion->query($consulta);
    }

    // Obtener todos los almacenes
    $consulta = "SELECT id_almacen, departamento, ciudad, calle, numero_puerta, coordenadas, capacidad, estado FROM almacen";
    $resultados = $conexion->query($consulta);
    ?>


    <div class="tablaDiv">

        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Departamento</th>
                    <th>Ciudad</th>
                    <th>Calle</th>
                    <th>Numero de puerta</th>
                    <th>Coordenadas</th>
                    <th>Capacidad</th>
                    <th>Estado</th>
                    <th>Modificar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($fila = $resultados->fetch_assoc()) {
                    $id_almacen = $fila["id_almacen"];
                    $departamento = $fila["departamento"];
                    $ciudad = $fila["ciudad"];
                    $calle = $fila["calle"];
                    $numero_puerta = $fila["numero_puerta"];
                    $coordenadas = $fila["coordenadas"];
                    $capacidad = $fila["capacidad"];
                    $estado = $fila["estado"];

                    echo "<tr>";
                    echo "<td>$id_almacen</td>";
                    echo "<td>$departamento</td>";
                    echo "<td>$ciudad</td>";
                    echo "<td>$calle</td>";
                    echo "<td>$numero_puerta</td>";
                    echo "<td>$coordenadas</td>";
                    echo "<td>$capacidad</td>";
                    echo "<td>$estado</td>";
                    echo "<td><form action='modificarAlmacen.php' method='get'><input type='hidden' name='id_almacen' value='$id_almacen'><button type='submit' name='modificar'>Modificar</button></form></td>";
                    echo "<td><form action='' method='post' onsubmit='return confirmarEliminar();'><input type='hidden' name='id_almacen' value='$id_almacen'><button type='submit' name='eliminar' id='modificar'>Eliminar</button></form></td>";
                    echo "</tr>";
                }

                // Procesar el formulario de eliminación
                if (isset($_POST['eliminar']) && isset($_POST['id_almacen'])) {
                    $id_almacen_a_eliminar = $_POST['id_almacen'];
                    if (eliminarAlmacen($id_almacen_a_eliminar)) {
                        echo '<script>alert("Almacen eliminado exitosamente");</script>';
                        echo '<script>window.location.href="datosAlmacen.php";</script>';
                    } else {
                        echo '<script>alert("Error al eliminar el almacen");</script>';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="volver">
        <input type="button" value="Volver" onclick="window.location.href='controlAlmacenes.php'">
    </div>
    <script src="script.js"></script>
    <script>
        // Función para mostrar una confirmación antes de eliminar
        function confirmarEliminar() {
            return confirm('¿Seguro que desea eliminar este almacen?');
        }
    </script>
</body>

</html>