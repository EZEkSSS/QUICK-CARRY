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
        <li><a href="controlCamiones.php">Control de camiones</a></li>
        <li><a href="controlAlmacenes.php">Control de almacenes</a></li>
    </ul>

</header>

<body>
    <h1>Añadir almacen</h1>

    <div class="formulario">

        <form action="altasAlmacen.php" method="post">
            <b>Departanto:</b> <input type="text" name="departamento" required> <br><br>
            <b>Ciudad:</b> <input type="text" name="ciudad" required> <br><br>
            <b>Calle:</b> <input type="text" name="calle" required> <br><br>
            <b>Numero_Puerta:</b> <input type="text" name="numero_puerta" required> <br><br>
            <b>capacidad:</b> <input type="text" name="capacidad" required> <br><br>


            <input type="submit" value="Añadir">
            <input type="button" value="Volver" onclick="window.location.href='controlAlmacenes.php'">
        </form>

    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $conexion = new mysqli("localhost", "root", "", "usuarios");
        $departamento = $_POST["departamento"];
        $ciudad = $_POST["ciudad"];
        $calle = $_POST["calle"];
        $numero_puerta = $_POST["numero_puerta"];
        $capacidad = $_POST["capacidad"];


        $sentencia = "INSERT INTO almacenes VALUES (NULL, '$departamento', '$ciudad', '$calle', '$numero_puerta','$capacidad')";

        if ($conexion->query($sentencia) === TRUE) {
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