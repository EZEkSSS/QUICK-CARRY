<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="qc.png">
    <title>Modificar vehiculo</title>
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
    <?php
    $conexion = new mysqli("localhost", "root", "", "quickcarry");

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["matricula"]) && isset($_GET["tipo"])) {
        $matricula = $_GET["matricula"];
        $tipo = $_GET["tipo"];

        // Obtener los detalles del vehiculo seleccionado
        if ($tipo === 'Camioneta') {
            $consulta = "SELECT v.matricula, v.marca, v.modelo, v.tipo, v.capacidad_carga, v.estado, camioneta.id_almacen FROM vehiculo v LEFT JOIN camioneta on v.matricula = camioneta.matricula WHERE v.matricula = '$matricula'";
        } else {
            $consulta = "SELECT matricula, marca, modelo, tipo, capacidad_carga, estado FROM vehiculo WHERE matricula = '$matricula'";
        }
        $resultado = $conexion->query($consulta);
        $vehiculo = $resultado->fetch_assoc();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $matricula = $_POST["matricula"];
        $marca = $_POST["marca"];
        $modelo = $_POST["modelo"];
        $capacidad_carga = $_POST["capacidad_carga"];
        $tipo = $_POST["tipo"];
        if ($tipo === 'Camioneta') {
            $id_almacen = $_POST['id_almacen'];
        }
        $estado = $_POST["estado"];

        // Actualizar los datos en la base de datos
        $sentencia = "UPDATE vehiculo SET matricula = '$matricula', marca = '$marca', modelo = '$modelo', capacidad_carga = '$capacidad_carga', estado = '$estado' WHERE matricula = '$matricula'";
        if ($conexion->query($sentencia) === TRUE) {
            $mensaje = "Vehiculo modificado exitosamente";
        } else {
            $mensaje = "Error al modificar el vehiculo: " . $conexion->error;
        }
        if ($tipo === 'Camioneta') {
            $sentencia2 = "UPDATE camioneta SET id_almacen = '$id_almacen' WHERE matricula = '$matricula'";
            $conexion->query($sentencia2);
        }
    }
    ?>
    <h1>Modificar Vehiculo</h1>
    <?php if (isset($mensaje)): ?>
        <p>
            <?php echo $mensaje; ?>
        </p>
    <?php endif; ?>
    <div class="formulario">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <?php if (isset($vehiculo)): ?>
                <label for="matricula">Matricula:</label>
                <input type="text" name="matricula" readonly value="<?php echo $vehiculo['matricula']; ?>"><br><br>
                <label for="marca">Marca:</label>
                <input type="text" id="marca" name="marca" value="<?php echo $vehiculo['marca']; ?>"><br><br>
                <label for="modelo">Modelo:</label>
                <input type="text" id="modelo" name="modelo" value="<?php echo $vehiculo['modelo']; ?>"><br><br>
                <label for="capacidad_carga">Capacidad de carga:</label>
                <input type="number" id="capacidad_carga" name="capacidad_carga"
                    value="<?php echo $vehiculo['capacidad_carga']; ?>"><br><br>
                <label for="tipo">Tipo:</label>
                <input type="text" id="tipo" name="tipo" readonly value="<?php echo $vehiculo['tipo']; ?>"><br><br>
                <?php if ($vehiculo['tipo'] === 'Camioneta'): ?>
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
                    <option value="Disponible" <?php if ($vehiculo['estado'] == 'Disponible')
                        echo 'selected'; ?>>Disponible
                    </option>
                    <option value="No disponible" <?php if ($vehiculo['estado'] == 'No disponible')
                        echo 'selected'; ?>>No
                        disponible</option>
                </select><br><br>

                <input type="submit" value="Guardar Cambios">
            <?php endif; ?>
        </form>
    </div>

    <div class="volver">
        <input type="button" value="Volver" onclick="window.location.href='datosVehiculo.php'">
    </div>

    <script src="script.js"></script>
</body>

</html>