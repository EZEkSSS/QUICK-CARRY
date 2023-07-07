<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="qc.png">
    <title>Modificar usuarios</title>
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
    <h1>Modificar usuarios</h1>

    <?php
    $conexion = new mysqli("localhost", "root", "", "usuarios");
    $mensaje = '';

    // Actualizar datos del usuario seleccionado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST["usuario"];
        $nombre = $_POST["nombre$id"];
        $apellido = $_POST["apellido$id"];
        $telefono = $_POST["telefono$id"];
        $email = $_POST["email$id"];
        $ci = $_POST["ci$id"];
        $cargo = $_POST["cargo$id"];
        $categoria_libreta = $_POST["categoria_libreta$id"];
        $estado = $_POST["estado$id"];


        $sentencia = "UPDATE personas SET nombre = '$nombre', apellido = '$apellido', telefono = '$telefono', email = '$email', ci = '$ci', cargo='$cargo', categoria_libreta='$categoria_libreta', estado='$estado' WHERE id = $id";

        if ($conexion->query($sentencia) === TRUE) {
            $mensaje = "Usuario modificado exitosamente";
        } else {
            $mensaje = "Error al modificar el usuario: " . $conexion->error;
        }
    }

    // Consigue a todos los usuarios
    $consulta = "SELECT id, nombre, apellido, telefono, email, ci, cargo, categoria_libreta FROM personas";
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
                        //modificacion de los datos
                        echo "<tr>";
                        echo "<td>$id</td>";
                        echo "<td><input type='text' name='nombre$id' value='$nombre'></td>";
                        echo "<td><input type='text' name='apellido$id' value='$apellido'></td>";
                        echo "<td><input type='text' name='telefono$id' value='$telefono'></td>";
                        echo "<td><input type='text' name='email$id' value='$email'></td>";
                        echo "<td><input type='text' name='ci$id' value='$ci'></td>";
                        echo "<td>
                            <select name='cargo$id' id='cargo$id' required>
                                <option value='personal_almacen'" . ($cargo == 'personal_almacen' ? ' selected' : '') . ">Personal de Almacén</option>
                                <option value='camionero'" . ($cargo == 'camionero' ? ' selected' : '') . ">Camionero</option>
                                <option value='admin'" . ($cargo == 'admin' ? ' selected' : '') . ">Administrador</option>
                            </select>
                        </td>";
                        echo "<td>
                            <select name='categoria_libreta$id' id='categoria_libreta$id' required>
                                <option value=' '" . ($categoria_libreta == ' ' ? ' selected' : '') . "> </option>
                                <option value='A'" . ($categoria_libreta == 'A' ? ' selected' : '') . ">A</option>
                                <option value='B'" . ($categoria_libreta == 'B' ? ' selected' : '') . ">B</option>
                                <option value='C'" . ($categoria_libreta == 'C' ? ' selected' : '') . ">C</option>
                                <option value='D'" . ($categoria_libreta == 'D' ? ' selected' : '') . ">D</option>
                                <option value='E'" . ($categoria_libreta == 'E' ? ' selected' : '') . ">E</option>
                            </select>
                        </td>";
                        echo "<td>
                        <select name='estado$id' id='estado$id' required>
                            <option value='1'" . ($estado == '1' ? ' selected' : '') . ">1</option>
                            <option value='0'" . ($estado == '0' ? ' selected' : '') . ">0</option>
                        </select>
                        </td>";

                        echo "<td><button type='submit' name='usuario' value='$id'>Guardar</button></td>";
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