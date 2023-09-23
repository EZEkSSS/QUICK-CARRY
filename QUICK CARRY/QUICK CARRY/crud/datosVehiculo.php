<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="qc.png">
    <title>Lista de vehiculos</title>
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
    <h1>Lista de vehiculos</h1>

    <?php
    $conexion = new mysqli("localhost", "root", "", "quickcarry");

    // Función para eliminar un vehiculo
    function eliminarVehiculo($matricula)
    {
        global $conexion;
        $matricula = $conexion->real_escape_string($matricula);
        $consulta = "DELETE FROM vehiculo WHERE matricula = '$matricula'";
        return $conexion->query($consulta);
    }

    // Función para eliminar un vehiculo de la tabla camion o camioneta
    function eliminarTipoVehiculo($matricula, $tipo)
    {
        global $conexion;
        $matricula = $conexion->real_escape_string($matricula);
        $tipo = $conexion->real_escape_string($tipo);
        if ($tipo == 'Camion') {
            $consulta = "DELETE FROM camion WHERE matricula = '$matricula'";
        } else if($tipo == 'Camioneta') {
            $consulta = "DELETE FROM camioneta WHERE matricula = '$matricula'";
        }
        return $conexion->query($consulta);
    }

    // Obtener todos los vehiculos
    $consulta = "SELECT v.matricula, v.marca, v.modelo, v.tipo, v.capacidad_carga, camioneta.id_almacen, v.carga_actual, v.estado FROM vehiculo v LEFT JOIN camioneta ON v.matricula = camioneta.matricula";
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
                    <th>Capacidad de Carga</th>
                    <th>Carga actual</th>
                    <th>Almacen</th>
                    <th>Estado</th>
                    <th>Modificar</th>
                    <th>Eliminar</th>
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
                    $carga_actual = $fila["carga_actual"];
                    $id_almacen = $fila ["id_almacen"];
                    $estado = $fila["estado"];

                    echo "<tr>";
                    echo "<td>$matricula</td>";
                    echo "<td>$marca</td>";
                    echo "<td>$modelo</td>";
                    echo "<td>$tipo</td>";
                    echo "<td>$capacidad_carga</td>";
                    echo "<td>$carga_actual</td>";
                    echo "<td>$id_almacen</td>";
                    echo "<td>$estado</td>";
                    echo "<td><form action='modificarVehiculo.php' method='get'><input type='hidden' name='matricula' value='$matricula'><input type='hidden' name='tipo' value='$tipo'><button type='submit' name='modificar'>Modificar</button></form></td>";
                    echo "<td><form action='' method='post' onsubmit='return confirmarEliminar();'><input type='hidden' name='matricula' value='$matricula'><input type='hidden' name='tipo' value='$tipo'><button type='submit' name='eliminar'>Eliminar</button></form></td>";
                    echo "</tr>";
                }

                // Procesar el formulario de eliminación
                if (isset($_POST['eliminar']) && isset($_POST['matricula']) && isset($_POST['tipo'])) {
                    $matricula_a_eliminar = $_POST['matricula'];
                    $tipo_a_eliminar = $_POST['tipo'];
                    // Primero, elimina los registros de la tabla secundaria (camion)
                    if (eliminarTipoVehiculo($matricula_a_eliminar, $tipo_a_eliminar)) {
                        // Luego, elimina de la tabla principal (vehiculo)
                        if (eliminarVehiculo($matricula_a_eliminar)) {
                            echo '<script>alert("Vehiculo eliminado exitosamente");</script>';
                            echo '<script>window.location.href="datosVehiculo.php";</script>';
                        } else {
                            echo '<script>alert("Error al eliminar el vehiculo");</script>';
                        }
                    } else {
                        echo '<script>alert("Error al eliminar el tipo de vehiculo");</script>';
                    }
                }

                ?>
            </tbody>
        </table>
    </div>
    <div class="volver">
        <input type="button" value="Volver" onclick="window.location.href='controlVehiculos.php'">
    </div>
    <script src="script.js"></script>
    <script>
        // Función para mostrar una confirmación antes de eliminar
        function confirmarEliminar() {
            return confirm('¿Seguro que desea eliminar este camión?');
        }
    </script>
</body>

</html>