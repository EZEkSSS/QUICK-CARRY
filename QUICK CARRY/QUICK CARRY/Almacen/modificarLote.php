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
    <title>Modificar Lote</title>
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

    <?php
    // Consigo el almacen en el que trabaja el usuario
    $almacen = isset($_GET['almacen']) ? $_GET['almacen'] : '';

    // Conexión a la base de datos quickcarry
    $conexion = new mysqli("localhost", "root", "", "quickcarry");

    // Consigo el id del lote seleccionado
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
        // Obtener los valores de id y almacen de la URL (GET)
        $id_lote = $_GET['id'];
        $almacen = $_GET['almacen'];
    } elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"]) && isset($_POST["almacen"])) {
        // Si no se encontraron en la URL, obtener los valores de id y almacen de los datos POST
        $id_lote = $_POST['id'];
        $almacen = $_POST['almacen'];

        //  consulta SQL y otras operaciones
        // Comprueba si se ha enviado el formulario antes de actualizar el lote
        if (isset($_POST["guardarLote"])) {
            // Obtener los valores del formulario
            $departamento_destino = isset($_POST['departamento_destino']) ? $_POST['departamento_destino'] : '';
            $estado = isset($_POST['estado']) ? $_POST['estado'] : '';
            $peso = isset($_POST['peso']) ? $_POST['peso'] : '';

            // Consulta SQL de actualización
            $consultaUpdate = "UPDATE lote SET";

            // Construir la consulta SQL considerando los campos que han cambiado
            if (!empty($departamento_destino)) {
                $consultaUpdate .= " departamento_destino = '$departamento_destino',";
            }

            if (!empty($estado)) {
                $consultaUpdate .= " estado = '$estado',";
            }

            if (!empty($peso)) {
                $consultaUpdate .= " peso = $peso,";
            }

            // Eliminar la coma final si se agregaron campos a la consulta
            if (substr($consultaUpdate, -1) == ',') {
                $consultaUpdate = substr($consultaUpdate, 0, -1);
            }

            // Agregar la condición WHERE para actualizar el lote específico
            $consultaUpdate .= " WHERE id_lote = $id_lote";

            // Ejecutar la consulta de actualización
            if ($conexion->query($consultaUpdate) === TRUE) {
                echo "Lote actualizado correctamente.";
            } else {
                echo "Error al actualizar el lote: " . $conexion->error;
            }
        }
    } else {
        // Manejar el caso en el que no se proporcionaron los valores necesarios
        die("Error: Los valores de id y almacen no se proporcionaron correctamente.");
    }

    // COONSIGO LA INFORMACION DEL LOTE
    $consulta = "SELECT id_lote, departamento_destino, peso, estado FROM lote WHERE id_lote = $id_lote";
    $resultado = $conexion->query($consulta);

    if ($resultado && $resultado->num_rows > 0) {
        $lote = $resultado->fetch_assoc();
    } else {
        die("Error: El lote no existe o no se encontró.");
    }
    ?>


    <body>
        <h1>Gestion de lotes- <?php echo $almacen; ?></h1>
        <div class="modiLote">
            <form id="gestionLote" action="modificarLote.php" method="post">
                <h2>Modificar de Lote<?php echo $id_lote; ?></h2>
                <label for="departamento_destino">Destino Lote:</label>
                <select name="departamento_destino" id="departamento_destino">
                    <option value="" disabled selected><?php echo $lote['departamento_destino']; ?></option>
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
                <label for="estado">Estado:</label>
                <select name="estado" id="estado">
                    <option value=""><?php echo $lote['estado']; ?></option>
                    <option value="Armado">Armado</option>
                    <option value="En camino">En camino</option>
                    <option value="Entregado">Entregado</option>
                </select>

                <label for="peso">Peso:</label>
                <input type="text" name="peso" value="<?php echo $lote['peso']; ?>" readonly>

                <input type="hidden" name="id" value="<?php echo $id_lote; ?>">
                <input type="hidden" name="almacen" value="<?php echo $almacen; ?>">

                <input type="submit" name="guardarLote" value="Guardar Lote">
            </form>


            <?php
            // Obtener todos los paquetes disponibles en la almacen
            $consultaPaq = "SELECT id_paquete, peso, departamento_destinatario FROM PAQUETE  WHERE id_lote IS NULL";
            $resultadosPaq = $conexion->query($consultaPaq);



            // PARTE DE AGREGAR PAQUETE AL LOTE
            // Verificar si se ha enviado el formulario de "Agregar al lote"
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["agregar_paquete_lote"])) {
                // Obtener el ID del paquete y el ID del lote
                $id_paquete = $_POST["id_paquete"];
                $id_lote = $_POST["id"];

                // Realizar la consulta de actualización
                $consultaUpdatePaq = "UPDATE paquete SET id_lote = $id_lote WHERE id_paquete = $id_paquete";

                // Ejecutar la consulta
                $resultadoUpdatePaq = $conexion->query($consultaUpdatePaq);

                if ($resultadoUpdatePaq) {
                    // La actualización se realizó con éxito
                    echo "Paquete agregado al lote correctamente.";
                    // Redireccionar a la misma página
                    header("Location: modificarLote.php?id=$id_lote&almacen=$almacen");
                    exit(); // Asegurarse de que se detenga la ejecución del script
                }
            }



            //PARTE DE SACAR PAQUETE DEL LOTE

            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["sacar_paquete_lote"])) {
                // Obtener el ID del paquete y el ID del lote
                $id_paquete = $_POST["id_paquete"];
                $id_lote = $_POST["id"];

                // Realizar la consulta de actualización para establecer id_lote en NULL
                $consultaUpdatePaqLot = "UPDATE paquete SET id_lote = NULL WHERE id_paquete = $id_paquete";

                // Ejecutar la consulta
                $resultadoUpdatePaqLot = $conexion->query($consultaUpdatePaqLot);

                if ($resultadoUpdatePaqLot) {
                    // La actualización se realizó con éxito
                    echo "Paquete sacado del lote correctamente.";
                    // Redireccionar a la misma página
                    header("Location: modificarLote.php?id=$id_lote&almacen=$almacen");
                    exit(); // Asegurarse de que se detenga la ejecución del script
                }
            }


            ?>

            <form id="paqueteLote" action="modificarLote.php" method="post">

                <div class="tablaDivPaq">
                    <table id="paquetesDisponibles" border="1">
                        <thead>
                            <tr>
                                <th colspan="4">Paquetes disponibles en el almacén</th>
                            </tr>
                            <tr>
                                <th>Número Paquete</th>
                                <th>Destino Paquete</th>
                                <th>Peso</th>
                                <th>Agregar</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            // Mientras haya paquetes disponibles en el almacén
                            while ($filaPaq = $resultadosPaq->fetch_assoc()) {
                                $id_paquete = $filaPaq["id_paquete"];
                                $departamentoDestinatario = $filaPaq["departamento_destinatario"];
                                $pesoPaq = $filaPaq["peso"];

                                echo "<tr>";
                                echo "<td>$id_paquete</td>";
                                echo "<td>$departamentoDestinatario</td>";
                                echo "<td>$pesoPaq</td>";
                                echo '<td>
                                 <form id="form_agregar_' . $id_paquete . '" action="modificarLote.php" method="post">
                                     <input type="hidden" name="id_paquete" value="' . $id_paquete . '">
                                     <input type="hidden" name="almacen" value="' . $almacen . '">
                                     <input type="hidden" name="id" value="' . $id_lote . '">
                                     <button class="Agregar" type="submit" name="agregar_paquete_lote">Agregar</button>
                                 </form>
                             </td>';
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
            </form>


            <form id="lotePaquete" action="modificarLote.php" method="post">

                <?php
                $consultaPaqLote = "SELECT id_paquete,peso,departamento_destinatario FROM paquete WHERE id_lote = '$id_lote'";
                $resultadosPaqLot = $conexion->query($consultaPaqLote);
                ?>

                <table id="paquetesDentroLotes" border="1">
                    <thead>
                        <tr>
                            <th colspan="4">Paquetes dentro del Lote - <?php echo $id_lote; ?></th>
                        </tr>
                        <tr>
                            <th>Numero Paquete</th>
                            <th>Destino Paquete</th>
                            <th>Peso</th>
                            <th>Sacar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Mientras haya paquetes dentro del lote
                        while ($filaPaqLot = $resultadosPaqLot->fetch_assoc()) {
                            $id_paquete = $filaPaqLot["id_paquete"];
                            $departamentoDestinatario = $filaPaqLot["departamento_destinatario"];
                            $pesoPaq = $filaPaqLot["peso"];

                            echo "<tr>";
                            echo "<td> $id_paquete </td>";
                            echo "<td>$departamentoDestinatario</td>";
                            echo "<td>$pesoPaq </td>";
                            echo '<td>
        <form id="form_sacar_' . $id_paquete . '" action="modificarLote.php" method="post">
            <input type="hidden" name="id_paquete" value="' . $id_paquete . '">
            <input type="hidden" name="almacen" value="' . $almacen . '">
            <input type="hidden" name="id" value="' . $id_lote . '">
            <button class="Sacar" type="submit" name="sacar_paquete_lote">Sacar</button>
    </td>';
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>

            </form>
        </div>


        </div>







        <div class="volver">

            <input type="button" value="Volver" onclick="window.location.href='gestionLotes.php?almacen=<?php echo $almacen; ?>'">

        </div>

        <script src="script.js"></script>
    </body>

</html>