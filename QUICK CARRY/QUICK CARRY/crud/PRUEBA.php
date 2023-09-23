
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="qc.png">
    <title>Control de usuarios</title>
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


body>
    <h1>Control de usuarios</h1>

    <?php
    $conexion = new mysqli("localhost", "root", "", "usuarios");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // ... (código para cambiar el estado) ...

        $guardar_modificacion = isset($_POST["guardar_modificacion"]) ? $_POST["guardar_modificacion"] : "";

        if ($guardar_modificacion != "") {
            $nuevo_nombre = $_POST["nombre$guardar_modificacion"];
            $nuevo_apellido = $_POST["apellido$guardar_modificacion"];
            $nuevo_telefono = $_POST["telefono$guardar_modificacion"];
            $nuevo_email = $_POST["email$guardar_modificacion"];
            $nuevo_ci = $_POST["ci$guardar_modificacion"];
            $nuevo_cargo = $_POST["cargo$guardar_modificacion"];
            $nuevo_categoria_libreta = $_POST["categoria_libreta$guardar_modificacion"];

            $sentencia_modificacion = "UPDATE personas SET nombre = '$nuevo_nombre', apellido = '$nuevo_apellido', telefono = '$nuevo_telefono', email = '$nuevo_email', ci = '$nuevo_ci', cargo = '$nuevo_cargo', categoria_libreta = '$nuevo_categoria_libreta' WHERE id = $guardar_modificacion";

            if ($conexion->query($sentencia_modificacion) === TRUE) {
                echo "<p>Usuario modificado exitosamente</p>";
            } else {
                echo "<p>Error al modificar el usuario: " . $conexion->error . "</p>";
            }
        }
    }

    // Obtener todos los usuarios
    $consulta = "SELECT id, nombre, apellido, telefono, email, ci, cargo, categoria_libreta, estado FROM personas";
    $resultados = $conexion->query($consulta);
    ?>

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
                // Datos de los usuarios
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

                    echo "<tr>";
                    echo "<td>$id</td>";
                    echo "<td>";
                    if (isset($_POST["modificar_usuario"]) && $_POST["modificar_usuario"] == $id) {
                        echo "<input type='text' name='nombre$id' value='$nombre'>";
                    } else {
                        echo $nombre;
                    }
                    echo "</td>";
                    echo "<td>";
                    if (isset($_POST["modificar_usuario"]) && $_POST["modificar_usuario"] == $id) {
                        echo "<input type='text' name='apellido$id' value='$apellido'>";
                    } else {
                        echo $apellido;
                    }
                    echo "</td>";
                    echo "<td>";
                    if (isset($_POST["modificar_usuario"]) && $_POST["modificar_usuario"] == $id) {
                        echo "<input type='text' name='telefono$id' value='$telefono'>";
                    } else {
                        echo $telefono;
                    }
                    echo "</td>";
                    echo "<td>";
                    if (isset($_POST["modificar_usuario"]) && $_POST["modificar_usuario"] == $id) {
                        echo "<input type='text' name='email$id' value='$email'>";
                    } else {
                        echo $email;
                    }
                    echo "</td>";
                    echo "<td>";
                    if (isset($_POST["modificar_usuario"]) && $_POST["modificar_usuario"] == $id) {
                        echo "<input type='text' name='ci$id' value='$ci'>";
                    } else {
                        echo $ci;
                    }
                    echo "</td>";
                    echo "<td>";
                    if (isset($_POST["modificar_usuario"]) && $_POST["modificar_usuario"] == $id) {
                        echo "<input type='text' name='cargo$id' value='$cargo'>";
                    } else {
                        echo $cargo;
                    }
                    echo "</td>";
                    echo "<td>";
                    if (isset($_POST["modificar_usuario"]) && $_POST["modificar_usuario"] == $id) {
                        echo "<input type='text' name='categoria_libreta$id' value='$categoria_libreta'>";
                    } else {
                        echo $categoria_libreta;
                    }
                    echo "</td>";
                    echo "<td>";
                    echo "<form action='' method='post'>";
                    echo "<input type='hidden' name='cambio_usuario' value='$id'>";
                    echo "<button type='submit'>Cambiar Estado</button>";
                    echo "</form>";
                    echo "</td>";
                    echo "<td>";
                    if (isset($_POST["modificar_usuario"]) && $_POST["modificar_usuario"] == $id) {
                        echo "<button type='submit' name='guardar_modificacion' value='$id'>Guardar</button>";
                    } else {
                        echo "<form action='' method='post'>";
                        echo "<input type='hidden' name='modificar_usuario' value='$id'>";
                        echo "<button type='submit'>Modificar</button>";
                        echo "</form>";
                    }
                    echo "</td>";
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