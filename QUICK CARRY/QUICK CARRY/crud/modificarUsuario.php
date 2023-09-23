<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="qc.png">
    <title>Modificar usuario</title>
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
        <li><a href="controlCamiones.php">Control de vehiculos</a></li>
        <li><a href="controlAlmacenes.php">Control de almacenes</a></li>
    </ul>

</header>

<body>
    <?php
    $conexion = new mysqli("localhost", "root", "", "quickcarry");

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["ci"]) && isset($_GET["cargo"])) {
        $ci = $_GET["ci"];
        $cargo = $_GET["cargo"];

        // Obtener los detalles del usuario seleccionado
        if ($cargo == 'camionero') {
            $consulta = "SELECT p.ci, p.nombre, p.apellido, p.email, p.cargo, camionero.libreta, p.estado FROM persona p LEFT JOIN camionero ON p.ci = camionero.ci WHERE p.ci = '$ci'";
        } else if ($cargo == 'funcionario_almacen') {
            $consulta = "SELECT p.ci, p.nombre, p.apellido, p.email, p.cargo, funcionario_almacen.id_almacen, p.estado FROM persona p LEFT JOIN funcionario_almacen ON p.ci = funcionario_almacen.ci WHERE p.ci = '$ci'";
        } else {
            $consulta = "SELECT ci, nombre, apellido, email, cargo, estado FROM persona WHERE ci = '$ci'";
        }
        $resultado = $conexion->query($consulta);
        $usuario = $resultado->fetch_assoc();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $ci = $_POST["ci"];
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $email = $_POST["email"];
        $cargo = $_POST["cargo"];
        if ($cargo === 'camionero') {
            $libreta = $_POST['libreta'];
        }
        if ($cargo === 'funcionario_almacen') {
            $id_almacen = $_POST['id_almacen'];
        }
        $estado = $_POST["estado"];

        $sentencia1 = "UPDATE persona SET nombre = '$nombre', apellido = '$apellido', email = '$email', estado = '$estado' WHERE ci = $ci";
        if ($conexion->query($sentencia1) === TRUE) {
            $mensaje = "Usuario modificado exitosamente";
        } else {
            $mensaje = "Error al modificar el usuario: " . $conexion->error;
        }
        if ($cargo === 'camionero') {
            $sentencia2 = "UPDATE camionero SET libreta = '$libreta' WHERE ci = $ci";
            $conexion->query($sentencia2);
        } else if ($cargo === 'funcionario_almacen') {
            $sentencia2 = "UPDATE funcionario_almacen SET id_almacen = '$id_almacen' WHERE ci = '$ci'";
            $conexion->query($sentencia2);
        }

    }
    ?>
    <h1>Modificar Usuario</h1>
    <?php if (isset($mensaje)): ?>
        <p>
            <?php echo $mensaje; ?>
        </p>
    <?php endif; ?>
    <div class="formulario">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <?php if (isset($usuario)): ?>
                <label for="ci">CI:</label>
                <input type="text" name="ci" readonly value="<?php echo $usuario['ci']; ?>"><br><br>
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo $usuario['nombre']; ?>"><br><br>
                <label for="apellido">Apellido:</label>
                <input type="text" id="apellido" name="apellido" value="<?php echo $usuario['apellido']; ?>"><br><br>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $usuario['email']; ?>"><br><br>
                <label for="cargo">Cargo:</label>
                <input type="text" id="cargo" name="cargo" readonly value="<?php echo $usuario['cargo']; ?>"><br><br>
                <?php if ($usuario['cargo'] === 'camionero'): ?>
                    <label for="libreta">Libreta:</label>
                    <select id="libreta" name="libreta">
                        <option value="A" <?php if ($usuario['libreta'] === 'A')
                            echo 'selected'; ?>>A</option>
                        <option value="B" <?php if ($usuario['libreta'] === 'B')
                            echo 'selected'; ?>>B</option>
                        <option value="C" <?php if ($usuario['libreta'] === 'C')
                            echo 'selected'; ?>>C</option>
                        <option value="D" <?php if ($usuario['libreta'] === 'D')
                            echo 'selected'; ?>>D</option>
                        <option value="E" <?php if ($usuario['libreta'] === 'E')
                            echo 'selected'; ?>>E</option>
                    </select><br><br>

                <?php elseif ($usuario['cargo'] === 'funcionario_almacen'): ?>
                    <label for="id_almacen">Almacén:</label>
                    <select id="id_almacen" name="id_almacen">
                        <?php
                        // Conexión a la base de datos (ajusta los detalles de conexión según tu configuración)
                        $conexion = new mysqli("localhost", "root", "", "quickcarry");

                        // Consulta SQL para obtener los almacenes disponibles
                        $sql = "SELECT id_almacen FROM ALMACEN";
                        $resultado = $conexion->query($sql);

                        if ($resultado->num_rows > 0) {
                            while ($row = $resultado->fetch_assoc()) {
                                $id_almacen = $row['id_almacen'];
                                $selected = ($usuario['id_almacen'] == $id_almacen) ? 'selected' : '';
                                echo "<option value='$id_almacen' $selected>$id_almacen</option>";
                            }
                        }

                        // Cerrar la conexión a la base de datos
                        $conexion->close();
                        ?>
                    </select><br><br>
                <?php endif; ?>
                <label for="estado">Estado:</label>
                <select id="estado" name="estado">
                    <option value="Activo" <?php if ($usuario['estado'] === 'Activo')
                        echo 'selected'; ?>>Activo</option>
                    <option value="Inactivo" <?php if ($usuario['estado'] === 'Inactivo')
                        echo 'selected'; ?>>Inactivo
                    </option>
                </select><br><br>
                <input type="submit" value="Guardar Cambios">
            <?php endif; ?>
        </form>
    </div>

    <div class="volver">
        <input type="button" value="Volver" onclick="window.location.href='datosUsuario.php'">
    </div>
</body>

</html>