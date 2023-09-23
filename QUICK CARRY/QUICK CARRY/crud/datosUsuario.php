<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="qc.png">
    <title>Lista de usuarios</title>
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
    <h1>Lista de usuarios</h1>

    <?php
    $conexion = new mysqli("localhost", "root", "", "quickcarry");

    // Obtener todos los usuarios
    $consulta = "SELECT p.ci, p.nombre, p.apellido, p.email, p.cargo, funcionario_almacen.id_almacen, camionero.libreta, p.estado FROM persona p LEFT JOIN funcionario_almacen ON p.ci = funcionario_almacen.ci LEFT JOIN camionero ON p.ci = camionero.ci";
    $resultados = $conexion->query($consulta);
    ?>


    <div class="tablaDiv">
        <table border="1">
            <thead>
                <tr>
                    <th>CI</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Cargo</th>
                    <th>Almacen</th>
                    <th>Libreta</th>
                    <th>Estado</th>
                    <th>Modificar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($fila = $resultados->fetch_assoc()) {
                    $ci = $fila["ci"];
                    $nombre = $fila["nombre"];
                    $apellido = $fila["apellido"];
                    $email = $fila["email"];
                    $cargo = $fila["cargo"];
                    $id_almacen = $fila["id_almacen"];
                    $libreta = $fila["libreta"];
                    $estado = $fila["estado"];
                    echo "<tr>";
                    echo "<td>$ci</td>";
                    echo "<td>$nombre</td>";
                    echo "<td>$apellido</td>";
                    echo "<td>$email</td>";
                    echo "<td>$cargo</td>";
                    echo "<td>$id_almacen</td>";
                    echo "<td>$libreta</td>";
                    echo "<td>$estado</td>";
                    echo "<td><form action='modificarUsuario.php' method='get'><input type='hidden' name='ci' value='$ci'><input type='hidden' name='cargo' value='$cargo'><button type='submit' name='modificar'>Modificar</button></form></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="volver">
        <input type="button" value="Volver" onclick="window.location.href='controlUsuarios.php'">
    </div>
    <script src="script.js"></script>
</body>

</html>
