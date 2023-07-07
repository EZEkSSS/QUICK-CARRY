<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="qc.png">
    <title>Lista de usuarios</title>
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
    <h1>Lista de usuarios</h1>

    <?php
    $conexion = new mysqli("localhost", "root", "", "usuarios");

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



                </tr>
            </thead>
            <tbody>
        
                <?php
                //datos de los usuarios
                while ($fila = $resultados->fetch_assoc()) {
                    $id = $fila["id"];
                    $nombre = $fila["nombre"];
                    $apellido = $fila["apellido"];
                    $telefono = $fila["telefono"];
                    $email = $fila["email"];
                    $ci = $fila["ci"];
                    $cargo = $fila["cargo"]?? '';
                    $categoria_libreta = $fila["categoria_libreta"]?? '';
                    $estado = $fila["estado"]?? '';



                    echo "<tr>";

                    echo "<td>$id</td>";
                    echo "<td>$nombre</td>";
                    echo "<td>$apellido</td>";
                    echo "<td>$telefono</td>";
                    echo "<td>$email</td>";
                    echo "<td>$ci</td>";
                    echo "<td>$cargo</td>";
                    echo "<td>$categoria_libreta</td>";
                    echo "<td>$estado</td>";


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