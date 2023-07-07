<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="qc.png">
    <title>Cambio estado usuarios</title>
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
    <h1>Cambio estado usuarios</h1>

    <?php
    $conexion = new mysqli("localhost", "root", "", "usuarios");
    $mensaje = '';

    // Actualiza datos del usuario seleccionado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST["usuario"];

        // Obtener el estado actual del usuario
        $consulta_estado = "SELECT estado FROM personas WHERE id = $id";
        $resultado_estado = $conexion->query($consulta_estado);
        $fila_estado = $resultado_estado->fetch_assoc();
        $estado_actual = $fila_estado["estado"];

        // Cambiar el estado
        $nuevo_estado = ($estado_actual == 1) ? 0 : 1;

        $sentencia = "UPDATE personas SET estado = $nuevo_estado WHERE id = $id";

        if ($conexion->query($sentencia) === TRUE) {
            $mensaje = "Estado del usuario modificado exitosamente";
        } else {
            $mensaje = "Error al modificar el estado del usuario: " . $conexion->error;
        }
    }

    // Consigue a todos los usuarios
    $consulta = "SELECT id, nombre, apellido, telefono, email, ci, cargo, categoria_libreta, estado FROM personas";
    $resultados = $conexion->query($consulta);
    ?>


    <form action="" method="post">
        <div class="tablaDiv">
            <table border="1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Ci</th>
                        <th>Cargo</th>
                        <th>Categoria_libreta</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //datos del usuario
                    while ($fila = $resultados->fetch_assoc()) {
                        $id = $fila["id"];
                        $nombre = $fila["nombre"];
                        $apellido = $fila["apellido"];
                        $telefono = $fila["telefono"];
                        $email = $fila["email"];
                        $ci = $fila["ci"];
                        $cargo = $fila["cargo"] ?? '';
                        $categoria_libreta = $fila["categoria_libreta"] ?? '';
                        $estado = $fila["estado"] ?? '';
                        //muestra los datos y permite cambiar el estado del usuario
                        echo "<tr>";
                        echo "<td>$id</td>";
                        echo "<td>$nombre</td>";
                        echo "<td>$apellido</td>";
                        echo "<td>$telefono</td>";
                        echo "<td>$email</td>";
                        echo "<td>$ci</td>";
                        echo "<td>$cargo</td>";
                        echo "<td>$categoria_libreta</td>";
                        echo "<td>$estado</td>";
                        echo "<td><button type='submit' name='usuario' value='$id'>Cambio</button></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </form>
    <div class="volver">
        <input type="button" value="Volver" onclick="window.location.href='controlUsuarios.php'">
    </div>
    <p><?php echo $mensaje; ?></p>
    <script src="script.js"></script>
</body>

</html>