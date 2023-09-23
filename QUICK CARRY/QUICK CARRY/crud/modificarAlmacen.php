<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="qc.png">
    <title>Modificar almacen</title>
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

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id_almacen"])) {
        $id_almacen = $_GET["id_almacen"];

        // Obtener los detalles del almacen seleccionado
        $consulta = "SELECT id_almacen, departamento, ciudad, calle, numero_puerta, coordenadas, capacidad, estado FROM almacen WHERE id_almacen = $id_almacen";
        $resultado = $conexion->query($consulta);
        $almacen = $resultado->fetch_assoc();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_almacen = $_POST["id_almacen"];
        $departamento = $_POST["departamento"];
        $ciudad = $_POST["ciudad"];
        $calle = $_POST["calle"];
        $numero_puerta = $_POST["numero_puerta"];
        $coordenadas = $_POST["coordenadas"];
        $capacidad = $_POST["capacidad"];
        $estado = $_POST["estado"];

        // Actualizar los datos en la base de datos
        $sentencia = "UPDATE almacen SET departamento = '$departamento', ciudad = '$ciudad', calle = '$calle', numero_puerta = '$numero_puerta', coordenadas = '$coordenadas', capacidad = '$capacidad', estado = '$estado' WHERE id_almacen = $id_almacen";

        if ($conexion->query($sentencia) === TRUE) {
            $mensaje = "Almacen modificado exitosamente";
        } else {
            $mensaje = "Error al modificar el almacen: " . $conexion->error;
        }
    }
    ?>
    <h1>Modificar Almacen</h1>
    <?php if (isset($mensaje)): ?>
        <p>
            <?php echo $mensaje; ?>
        </p>
    <?php endif; ?>
    <div class="formulario">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <?php if (isset($almacen)): ?>
                <input type="hidden" name="id_almacen" value="<?php echo $almacen['id_almacen']; ?>">
                <label for="departamento">Departamento:</label>
                <select id="departamento" name="departamento">
                    <option value="Artigas" <?php if (isset($almacen) && $almacen['departamento'] === 'Artigas')
                        echo 'selected'; ?>>Artigas</option>
                    <option value="Canelones" <?php if (isset($almacen) && $almacen['departamento'] === 'Canelones')
                        echo 'selected'; ?>>Canelones</option>
                    <option value="Cerro Largo" <?php if (isset($almacen) && $almacen['departamento'] === 'Cerro Largo')
                        echo 'selected'; ?>>Cerro Largo</option>
                    <option value="Colonia" <?php if (isset($almacen) && $almacen['departamento'] === 'Colonia')
                        echo 'selected'; ?>>Colonia</option>
                    <option value="Durazno" <?php if (isset($almacen) && $almacen['departamento'] === 'Durazno')
                        echo 'selected'; ?>>Durazno</option>
                    <option value="Flores" <?php if (isset($almacen) && $almacen['departamento'] === 'Flores')
                        echo 'selected'; ?>>Flores</option>
                    <option value="Florida" <?php if (isset($almacen) && $almacen['departamento'] === 'Florida')
                        echo 'selected'; ?>>Florida</option>
                    <option value="Lavalleja" <?php if (isset($almacen) && $almacen['departamento'] === 'Lavalleja')
                        echo 'selected'; ?>>Lavalleja</option>
                    <option value="Maldonado" <?php if (isset($almacen) && $almacen['departamento'] === 'Maldonado')
                        echo 'selected'; ?>>Maldonado</option>
                    <option value="Montevideo" <?php if (isset($almacen) && $almacen['departamento'] === 'Montevideo')
                        echo 'selected'; ?>>Montevideo</option>
                    <option value="Paysandú" <?php if (isset($almacen) && $almacen['departamento'] === 'Paysandú')
                        echo 'selected'; ?>>Paysandú</option>
                    <option value="Río Negro" <?php if (isset($almacen) && $almacen['departamento'] === 'Río Negro')
                        echo 'selected'; ?>>Río Negro</option>
                    <option value="Rivera" <?php if (isset($almacen) && $almacen['departamento'] === 'Rivera')
                        echo 'selected'; ?>>Rivera</option>
                    <option value="Rocha" <?php if (isset($almacen) && $almacen['departamento'] === 'Rocha')
                        echo 'selected'; ?>>Rocha</option>
                    <option value="Salto" <?php if (isset($almacen) && $almacen['departamento'] === 'Salto')
                        echo 'selected'; ?>>Salto</option>
                    <option value="San José" <?php if (isset($almacen) && $almacen['departamento'] === 'San José')
                        echo 'selected'; ?>>San José</option>
                    <option value="Soriano" <?php if (isset($almacen) && $almacen['departamento'] === 'Soriano')
                        echo 'selected'; ?>>Soriano</option>
                    <option value="Tacuarembó" <?php if (isset($almacen) && $almacen['departamento'] === 'Tacuarembó')
                        echo 'selected'; ?>>Tacuarembó</option>
                    <option value="Treinta y Tres" <?php if (isset($almacen) && $almacen['departamento'] === 'Treinta y Tres')
                        echo 'selected'; ?>>Treinta y Tres</option>
                </select><br><br>

                <label for="ciudad">Ciudad:</label>
                <input type="text" id="ciudad" name="ciudad" value="<?php echo $almacen['ciudad']; ?>"><br><br>
                <label for="calle">Calle:</label>
                <input type="text" id="calle" name="calle" value="<?php echo $almacen['calle']; ?>"><br><br>
                <label for="numero_puerta">Numero de puerta:</label>
                <input type="number" id="numero_puerta" name="numero_puerta"
                    value="<?php echo $almacen['numero_puerta']; ?>"><br><br>
                <label for="coordenadas">Coordenadas:</label>
                <input type="text" id="coordenadas" name="coordenadas"
                    value="<?php echo $almacen['coordenadas']; ?>"><br><br>
                <label for="capacidad">Capacidad:</label>
                <input type="number" id="capacidad" name="capacidad" value="<?php echo $almacen['capacidad']; ?>"><br><br>
                <label for="estado">Estado:</label>
                <select id="estado" name="estado">
                    <option value="Activo" <?php if (isset($almacen) && $almacen['estado'] === 'Activo')
                        echo 'selected'; ?>>
                        Activo</option>
                    <option value="Inactivo" <?php if (isset($almacen) && $almacen['estado'] === 'Inactivo')
                        echo 'selected'; ?>>Inactivo</option>
                </select><br><br>
                <input type="submit" value="Guardar Cambios">
            <?php endif; ?>
        </form>
    </div>

    <div class="volver">
        <input type="button" value="Volver" onclick="window.location.href='datosAlmacen.php'">
    </div>

    <script src="script.js"></script>
</body>

</html>