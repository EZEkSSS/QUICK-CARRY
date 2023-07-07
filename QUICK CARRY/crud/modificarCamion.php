<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="qc.png">
    <title>Modificar camiones</title>
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
    <h1>Modificar camiones</h1>

    <?php
    $conexion = new mysqli("localhost", "root", "", "usuarios");
    $mensaje = '';

    // Actualizar datos del camion seleccionado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST["camion"];
        $matricula = $_POST["matricula$id"];
        $marca = $_POST["marca$id"];
        $modelo = $_POST["modelo$id"];
        $tipo = $_POST["tipo$id"];
        $capacidad_carga = $_POST["capacidad_carga$id"];
        $estado = $_POST["estado$id"];

        $sentencia = "UPDATE camiones SET matricula = '$matricula', marca = '$marca', modelo = '$modelo', tipo = '$tipo', capacidad_carga = '$capacidad_carga', estado = '$estado' WHERE id = $id";

        if ($conexion->query($sentencia) === TRUE) {
            $mensaje = "Camion modificado exitosamente";
        } else {
            $mensaje = "Error al modificar el camion: " . $conexion->error;
        }
    }

    // Obtener todos los camiones
    $consulta = "SELECT id, matricula, marca, modelo, tipo, capacidad_carga, estado FROM camiones";
    $resultados = $conexion->query($consulta);
    ?>

    <form action="" method="post">
        <div class="tablaDiv">
            <table border="1">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Matricula</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Tipo</th>
                        <th>Capacidad de Carga</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($fila = $resultados->fetch_assoc()) {
                        $id = $fila["id"];
                        $matricula = $fila["matricula"];
                        $marca = $fila["marca"];
                        $modelo = $fila["modelo"];
                        $tipo = $fila["tipo"];
                        $capacidad_carga = $fila["capacidad_carga"];
                        $estado = $fila["estado"];

                        echo "<tr>";
                        echo "<td>$id</td>";
                        echo "<td><input type='text' name='matricula$id' value='$matricula'></td>";
                        echo "<td><input type='text' name='marca$id' value='$marca'></td>";
                        echo "<td><input type='text' name='modelo$id' value='$modelo'></td>";
                        echo "<td><input type='text' name='tipo$id' value='$tipo'></td>";
                        echo "<td><input type='text' name='capacidad_carga$id' value='$capacidad_carga'></td>";
                        echo "<td><input type='text' name='estado$id' value='$estado'></td>";
                        echo "<td><button type='submit' name='camion' value='$id'>Guardar</button></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </form>
    <div class="volver">
        <input type="button" value="Volver" onclick="window.location.href='controlCamiones.php'">
    </div>
    <p><?php echo $mensaje; ?></p>
    <script src="script.js"></script>
</body>

</html>