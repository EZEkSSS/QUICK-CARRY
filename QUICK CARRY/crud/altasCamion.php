<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="qc.png">
    <title>Altas camion</title>
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
    <h1>Añadir camiones</h1>

    <div class="formulario">

        <form action="altasCamion.php" method="post">
            <b>Matricula:</b> <input type="text" name="matricula" required> <br><br>
            <b> Marca:</b> <input type="text" name="marca" required> <br><br>
            <b>Modelo:</b> <input type="text" name="modelo" required> <br><br>
            <b>Tipo:</b> <input type="text" name="tipo" required> <br><br>
            <b> capacidad_carga:</b> <input type="text" name="capacidad_carga" required> <br><br>
            <b>Estado:</b> <input type="text" name="estado" required> <br><br>


            <input type="submit" value="Añadir">
            <input type="button" value="Volver" onclick="window.location.href='controlCamiones.php'">
        </form>

    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $conexion = new mysqli("localhost", "root", "", "usuarios");
        $matricula = $_POST["matricula"];
        $marca = $_POST["marca"];
        $modelo = $_POST["modelo"];
        $tipo = $_POST["tipo"];
        $capacidad_carga = $_POST["capacidad_carga"];
        $estado = $_POST["estado"];


        $sentencia = "INSERT INTO camiones VALUES (NULL, '$matricula', '$marca', '$modelo', '$tipo','$capacidad_carga','$estado')";

        if ($conexion->query($sentencia) === TRUE) {
            echo "Camion añadido exitosamente";
        } else {
            echo "Error al añadir el Camion: " . $conexion->error;
        }

        $conexion->close();
    }
    ?>
    <script src="script.js"></script>
</body>

</html>