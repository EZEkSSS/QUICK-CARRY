<?php
$almacen = isset($_GET['almacen']) ? $_GET['almacen'] : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="qc.png">
    <title>Gestion de Lotes</title>
</head>
<header>

    <div class="logo">
        <a href="index.php?almacen=<?php echo $almacen; ?>"><img src="qc.png" alt="qc"></a>

        <h1>Quick Carry</h1>
    </div>


    <input type="checkbox" id="menu-toggle" class="menu-toggle">
    <label for="menu-toggle" class="menu-btn">
        <span></span>
        <span></span>
        <span></span>

    </label>
    <ul class="menu">
        <li><a href="altaPaquete.php?almacen=<?php echo $almacen; ?>">Alta de Paquetes</a></li>
        <li><a href="gestionLotes.php?almacen=<?php echo $almacen; ?>">Gestión de Lotes</a></li>
        <li><a href="gestionRecorridos.php?almacen=<?php echo $almacen; ?>">Gestión de Recorridos</a></li>
        <li><a href="datosPaquete.php?almacen=<?php echo $almacen; ?>">Ver paquetes</a></li>


    </ul>

</header>

<body>

    <h1>Gestion de lotes- <?php echo $almacen; ?></h1>

    <?php
    $conexion = new mysqli("localhost", "root", "", "quickcarry");

    // Obtener todos los lotes
    $consulta = "SELECT id_lote,departamento_destino, peso, estado
FROM lote";
    $resultados = $conexion->query($consulta);


    if (!$resultados) {
        die("Error en la consulta: " . $conexion->error);
    }


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_lote_cambiar = $_POST["id_lote_cambiar"];
        $nuevo_estado = $_POST["nuevo_estado"];

        if (($nuevo_estado === "Cerrado" || $nuevo_estado === "Abierto") && ($nuevo_estado !== $estado)) {
            $conexion = new mysqli("localhost", "root", "", "quickcarry");

            // Actualizar el estado del lote en la base de datos
            $consulta = "UPDATE lote SET estado = '$nuevo_estado' WHERE id_lote = $id_lote_cambiar";
            $resultado = $conexion->query($consulta);

            if ($resultado) {
                // Redirigir de vuelta a la página de lotes
                header("Location: gestionLotes.php?almacen=$almacen");
                exit;
            } else {
                echo "Error al cambiar el estado del lote: " . $conexion->error;
            }
        } else {
            echo "No se permite cambiar el estado a \"$nuevo_estado\" desde \"$estado\".";
        }
    }


    ?>
    <div class="tablas">
        <div class="altaLote">
            <h2>Alta de Lote</h2>
            <form action="gestionLotes.php?almacen=<?php echo $almacen; ?>" method="post">
                <label for="departamento_destino">Destino Lote:</label>
                <select name="departamento_destino" id="departamento_destino">
                    <option value="">Seleccione un departamento</option>
                    <option value="Artigas">Artigas</option>
                    <option value="Canelones">Canelones</option>
                    <option value="Cerro Largo">Cerro Largo</option>
                    <option value="Colonia">Colonia</option>
                    <option value="Durazno">Durazno</option>
                    <option value="Flores">Flores</option>
                    <option value="Florida">Florida</option>
                    <option value="Lavalleja">Lavalleja</option>
                    <option value="Maldonado">Maldonado</option>
                    <option value="Montevideo">Montevideo</option>
                    <option value="Paysandú">Paysandú</option>
                    <option value="Río Negro">Río Negro</option>
                    <option value="Rivera">Rivera</option>
                    <option value="Rocha">Rocha</option>
                    <option value="Salto">Salto</option>
                    <option value="San José">San José</option>
                    <option value="Soriano">Soriano</option>
                    <option value="Tacuarembó">Tacuarembó</option>
                    <option value="Treinta y Tres">Treinta y Tres</option>
                </select>


                <input type="hidden" name="almacen" value="<?php echo $almacen; ?>">
                <input type="submit" value="Añadir Lote">

            </form>
        </div>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $departamento_destino = $_POST["departamento_destino"];
            $estado = "Abierto";
            $peso = "0";

            $conexion = new mysqli("localhost", "root", "", "quickcarry");

            // Preparar y ejecutar la consulta de inserción
            $consulta = "INSERT INTO lote (departamento_destino, estado, peso) VALUES ('$departamento_destino', '$estado', '$peso')";
            $resultado = $conexion->query($consulta);

            if ($resultado) {
                // Redirigir de vuelta a la página de lotes
                header("Location: gestionLotes.php?almacen=$almacen");

                exit;
            } else {
                echo "Error al agregar el lote: " . $conexion->error;
            }
        }
        ?>



        <div class="tablaDivLot">

            <table border="1">
                <thead>
                    <tr>
                        <th>Numero Lote</th>
                        <th>Destino Lote</th>
                        <th>Estado</th>
                        <th>Peso</th>
                        <th>Modificar </th>
                        <th>Cerrar/Abrir </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($fila = $resultados->fetch_assoc()) {
                        $id_lote = $fila["id_lote"];
                        $departamento_destino = $fila["departamento_destino"];
                        $estado = $fila["estado"];
                        $peso = $fila["peso"];

                        echo "<tr>";
                        echo "<td>" . $id_lote . "</td>";
                        echo "<td>" . $departamento_destino . "</td>";
                        echo "<td>" . $estado . "</td>";
                        echo "<td>" . $peso . "</td>";

                        // Comprueba si el estado es "Cerrado" y muestra la alerta o el botón "Modificar"
                        if ($estado !== "Cerrado") {
                            echo "<td><form action='modificarLote.php' method='get'>
                        <input type='hidden' name='id' value='$id_lote'>
                        <input type='hidden' name='almacen' value='$almacen'>
                        <button class='boton-modificar'>Modificar</button>
                    </form>
                    </td>";
                        } else {
                            echo "<td><button class='boton-modificar button-disabled'>Modificar</button></td>";
                        }

                        echo "<td>
                    <form action='gestionLotes.php?almacen=$almacen' method='post'>
                        <input type='hidden' name='id_lote_cambiar' value='$id_lote'>
                        <input type='hidden' name='nuevo_estado' value='" . ($estado === "Cerrado" ? "Abierto" : "Cerrado") . "'>
                        <button class='CerrarAbrir' name='cambiar_estado' " . ($estado !== "Cerrado" && $estado !== "Abierto" ? "disabled" : "") . ">Cerrar/Abrir</button>
                    </form>
                </td>";
                        echo "</tr>";
                    }

                    ?>

                </tbody>
            </table>
        </div>
    </div>

    <div class="volver">


        <input type="button" value="Volver" onclick="window.location.href='index.php?almacen=<?php echo $almacen; ?>'">
    </div>
    <script src="script.js"></script>
</body>

</html>