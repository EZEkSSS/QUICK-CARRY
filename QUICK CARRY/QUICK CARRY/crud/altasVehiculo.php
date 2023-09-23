<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="qc.png">
    <title>Alta Vehiculo</title>
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
    <h1>Añadir vehiculo</h1>

    <div class="formulario">

        <form action="altasVehiculo.php" method="post">
            <input type="text" name="matricula" placeholder="Matricula" required> <br><br>
            <input type="text" name="marca" placeholder="Marca" required> <br><br>
            <input type="text" name="modelo" placeholder="Modelo" required> <br><br>
            <input type="number" name="capacidad" placeholder="Capacidad" required> <br><br>
            <select name="tipo" id="tipo" required>
                <option value="" disabled selected>Tipo:</option>
                <option value="Camion">Camion</option>
                <option value="Camioneta">Camioneta</option>
            </select> <br><br>

            <div id="almacenField" style="display:none;">
                <!-- Inicialmente oculto -->
                <?php
                $conexion = new mysqli("localhost", "root", "", "quickcarry");

                // Consulta SQL para obtener los IDs de todos los almacenes
                $sql = "SELECT id_almacen FROM ALMACEN";

                // Ejecutar la consulta
                $result = $conexion->query($sql);

                // Llenar las opciones del select con los IDs de los almacenes
                echo '<b><label for="id_almacen">Almacen:</label></b>';
                echo '<select name="id_almacen" id="id_almacen" required>';
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['id_almacen'] . '">' . $row['id_almacen'] . '</option>';
                    }
                }
                echo '</select><br><br>';

                // Cerrar la conexión a la base de datos
                $conexion->close();
                ?>
            </div>
            <select name="estado" id="estado" required>
                <option value="" disabled selected>Estado:</option>
                <option value="Disponible">Disponible</option>
                <option value="No disponible">No Disponible</option>
            </select> <br><br>

            <input type="submit" value="Añadir">
            <input type="button" value="Volver" onclick="window.location.href='controlVehiculos.php'">
        </form>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $conexion = new mysqli("localhost", "root", "", "quickcarry");
        $matricula = $_POST["matricula"];
        $marca = $_POST["marca"];
        $modelo = $_POST["modelo"];
        $tipo = $_POST["tipo"];
        $id_almacen = $_POST["id_almacen"];
        $capacidad_carga = $_POST["capacidad"];
        $estado = $_POST["estado"];


        $sentencia1 = "INSERT INTO vehiculo VALUES ('$matricula', '$marca', '$modelo', '$tipo', '$capacidad_carga', NULL, '$estado')";
        $sentencia2;

        if ($tipo == 'Camion') {
            $sentencia2 = "INSERT INTO camion VALUES ('$matricula')";
        } else {
            $sentencia2 = "INSERT INTO camioneta VALUES ('$matricula', '$id_almacen')";
        }

        if ($conexion->query($sentencia1) === TRUE && $conexion->query($sentencia2) === TRUE) {
            echo "<br>";
            echo "Vehiculo añadido exitosamente";
        } else {
            echo "Error al añadir el Vehiculo: " . $conexion->error;
        }

        $conexion->close();
    }
    ?>

    <script>
        // JavaScript para mostrar u ocultar el campo "ID del Almacén" según la selección en "Tipo"
        var tipoSelect = document.getElementById("tipo");
        var almacenField = document.getElementById("almacenField");

        tipoSelect.addEventListener("change", function () {
            if (tipoSelect.value === "Camioneta") {
                almacenField.style.display = "block";
            } else {
                almacenField.style.display = "none";
            }
        });
    </script>
</body>

</html>