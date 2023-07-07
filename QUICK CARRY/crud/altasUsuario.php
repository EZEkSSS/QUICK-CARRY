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
        <li><a href="controlCamiones.php">Control de camiones</a></li>
        <li><a href="controlAlmacenes.php">Control de almacenes</a></li>
    </ul>

</header>

<body>
    <h1>Añadir usuarios</h1>

    <div class="formulario">
        <form action="altasUsuario.php" name="entradas" method="post">
            <input type="text" name="nombre" placeholder="Nombre" required> <br><br>
            <input type="text" name="apellido" placeholder="Apellido" required> <br><br>
            <input type="text" name="telefono" placeholder="Telefono" required> <br><br>
            <input type="email" name="email" placeholder="Email" required> <br><br>
            <input type="text" name="ci" placeholder="Ci" required> <br><br>
            <select name="cargo" id="cargo" required>
                <option value="" disabled selected>Cargo:</option>
                <option value="personal_almacen">Personal de Almacén</option>
                <option value="camionero">Camionero</option>
                <option value="admin">Administrador</option>
            </select> <br><br>

            <div id="categoria-libreta" style="display: none;">
                <select name="categoria_libreta">
                    <option value="" disabled selected>Libreta:</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                    <option value="E">E</option>
                </select><br><br>
            </div>

            <input type="submit" value="Añadir">
            <input type="button" value="Volver" onclick="window.location.href='controlUsuarios.php'">
        </form>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $conexion = new mysqli("localhost", "root", "", "usuarios");

        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        $nombre = $_POST["nombre"] ?? '';
        $apellido = $_POST["apellido"] ?? '';
        $telefono = $_POST["telefono"] ?? '';
        $email = $_POST["email"] ?? '';
        $ci = $_POST["ci"] ?? '';
        $cargo = $_POST["cargo"] ?? '';
        $categoria_libreta = $_POST["categoria_libreta"] ?? '';

        // Generar contraseña a partir del CI
        $contrasena = $ci;

        // Establecer el estado como "true"
        $estado = true;

        $sentencia = "INSERT INTO personas (nombre, apellido, telefono, email, ci, cargo, categoria_libreta, contrasena, estado) VALUES ('$nombre', '$apellido', '$telefono', '$email', '$ci', '$cargo', '$categoria_libreta', '$contrasena', '$estado')";

        if ($conexion->query($sentencia) === TRUE) {
            echo "Usuario añadido exitosamente";
        } else {
            echo "Error al añadir el usuario: " . $conexion->error;
        }

        $conexion->close();
    }
    ?>


    <script>
        document.getElementById('cargo').addEventListener('change', function() {
            var categoriaLibreta = document.getElementById('categoria-libreta');
            categoriaLibreta.style.display = this.value === 'camionero' ? 'block' : 'none';
        });
    </script>
    <script src="script.js"></script>
</body>

</html>