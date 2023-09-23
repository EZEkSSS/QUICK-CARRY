<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="qc.png">
    <title>Alta almacen</title>
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
    <h1>Añadir almacen</h1>

    <div class="formulario">

        <form action="altasAlmacen.php" method="post">
            <input type="text" name="departamento" placeholder="Departamento" required> <br><br>
            <input type="text" name="ciudad" placeholder="Ciudad" required> <br><br>
            <input type="text" name="calle" placeholder="Calle" required> <br><br>
            <input type="number" name="numero_puerta" placeholder="Numero puerta" required> <br><br>
            <input type="text" name="coordenadas" placeholder="Coordenadas" required> <br><br>
            <input type="number" name="capacidad" placeholder="Capacidad" required> <br><br>
            <select name="estado" id="estado" required>
                <option value="" disabled selected>Estado:</option>
                <option value="Activo">Activo</option>
                <option value="Inactivo">Inactivo</option>
            </select> <br><br>

            <input type="submit" value="Añadir">
            <input type="button" value="Volver" onclick="window.location.href='controlAlmacenes.php'">
        </form>

    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $conexion = new mysqli("localhost", "root", "", "quickcarry");
        $departamento = $_POST["departamento"];
        $ciudad = $_POST["ciudad"];
        $calle = $_POST["calle"];
        $numero_puerta = $_POST["numero_puerta"];
        $coordenadas = $_POST["coordenadas"];
        $capacidad = $_POST["capacidad"];
        $estado = $_POST["estado"];


        $sentencia = "INSERT INTO almacen VALUES (NULL, '$departamento', '$ciudad', '$calle', '$numero_puerta', '$coordenadas', '$capacidad', '$estado')";

        if ($conexion->query($sentencia) === TRUE) {
            echo "<br>";
            echo "Almacen añadido exitosamente";
        } else {
            echo "Error al añadir el Almacen: " . $conexion->error;
        }

        $conexion->close();
    }
    ?>
    <script src="script.js"></script>
</body>

</html>