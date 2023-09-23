<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="qc.png">
    <title>Altas usuarios</title>
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
    <h1>Añadir usuarios</h1>

    <div class="formulario">
        <form action="altasUsuario.php" name="entradas" method="post">
            <input type="text" name="ci" placeholder="Ci" required> <br><br>
            <input type="text" name="nombre" placeholder="Nombre" required> <br><br>
            <input type="text" name="apellido" placeholder="Apellido" required> <br><br>
            <input type="email" name="email" placeholder="Email" required> <br><br>
            <select name="cargo" id="cargo" required>
                <option value="" disabled selected>Cargo:</option>
                <option value="Funcionario Almacen">Funcionario de Almacén</option>
                <option value="Camionero">Camionero</option>
                <option value="Admin">Administrador</option>
            </select> <br><br>
            <div id="categoria_libreta" style="display: none;">
                <select name="categoria_libreta">
                    <option value="" disabled selected>Libreta:</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                    <option value="E">E</option>
                </select><br><br>
            </div>
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

            <input type="submit" value="Añadir">
            <input type="button" value="Volver" onclick="window.location.href='controlUsuarios.php'">
        </form>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $conexion = new mysqli("localhost", "root", "", "quickcarry");

        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        $ci = $_POST["ci"] ?? '';
        $nombre = $_POST["nombre"] ?? '';
        $apellido = $_POST["apellido"] ?? '';
        $email = $_POST["email"] ?? '';
        $cargo = $_POST["cargo"] ?? '';
        $estado = 'Activo';
        if (isset($_POST["categoria_libreta"])) {
            $categoria_libreta = $_POST["categoria_libreta"];
        }
        if (isset($_POST["id_almacen"])) {
            $id_almacen = $_POST["id_almacen"];
        }
        $contrasena = $ci;

        $sentencia1 = "INSERT INTO usuario VALUES ('$ci', '$contrasena')";
        $sentencia2 = "INSERT INTO persona VALUES ('$ci', '$nombre', '$apellido', '$email', '$cargo', '$estado')";
        $sentencia3 = '';

        if ($cargo == 'Funcionario Almacen') {
            $sentencia3 = "INSERT INTO funcionario_almacen VALUES ('$ci', $id_almacen)";
        } else if ($cargo == 'Camionero') {
            $sentencia3 = "INSERT INTO camionero VALUES ('$ci', '$categoria_libreta')";
        }

        if ($conexion->query($sentencia1) === TRUE && $conexion->query($sentencia2) === TRUE) {
            echo "<br>";
            echo "Usuario añadido exitosamente";
        } else {
            echo "Error al añadir el usuario: " . $conexion->error;
        }

        if ($cargo != 'Admin') {
            $conexion->query($sentencia3);
        }

        $conexion->close();
    }
    ?>


    <script>
        document.getElementById('cargo').addEventListener('change', function () {
            var categoriaLibreta = document.getElementById('categoria_libreta');
            var almacenField = document.getElementById('almacenField');

            if (this.value === 'Camionero') {
                categoriaLibreta.style.display = 'block';
                almacenField.style.display = 'none';
            } else if (this.value === 'Funcionario Almacen') {
                categoriaLibreta.style.display = 'none';
                almacenField.style.display = 'block';
            } else {
                categoriaLibreta.style.display = 'none';
                almacenField.style.display = 'none';
            }
        });
    </script>

    <script src="script.js"></script>
</body>

</html>