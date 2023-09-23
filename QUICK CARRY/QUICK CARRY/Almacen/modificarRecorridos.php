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
    <title>Modificar Recorrido</title>
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

    // Consigo el id del recorrido seleccionado
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"]) && isset($_GET["almacen"])) {
        // Obtener los valores de id y almacen de la URL (GET)
        $id_recorrido = $_GET['id'];
        $almacen = $_GET['almacen'];

    } elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"]) && isset($_POST["almacen"])) {
        // Si no se encontraron en la URL, obtener los valores de id y almacen de los datos POST
        $id_recorrido = $_POST['id'];
        $almacen = $_POST['almacen'];

        //  consulta SQL y otras operaciones

        //GUARDAR RECORRIDO
        // Comprueba si se ha enviado el formulario antes de actualizar el recorrido
        if (isset($_POST["guardarRecorrido"])) {
            // Obtener los valores del formulario
            $matricula = isset($_POST['matricula']) ? $_POST['matricula'] : '';
            $departamento_destino = isset($_POST['departamento_destino']) ? $_POST['departamento_destino'] : '';
            $estado = isset($_POST['estado']) ? $_POST['estado'] : '';

            // Construir la consulta SQL de actualización en la tabla 'recorrido' solo si se han realizado cambios
            $consultaUpdateRecorrido = "UPDATE recorrido SET";

            if (!empty($matricula)) {
                $consultaUpdateRecorrido .= " matricula = '$matricula',";
            }

            if (!empty($departamento_destino)) {
                $consultaUpdateRecorrido .= " departamento_destino = '$departamento_destino',";
            }

            // Eliminar la coma final si se agregaron campos a la consulta
            if (substr($consultaUpdateRecorrido, -1) == ',') {
                $consultaUpdateRecorrido = substr($consultaUpdateRecorrido, 0, -1);
            }

            // Verificar si se han realizado cambios antes de ejecutar la consulta
            if (!empty($matricula) || !empty($departamento_destino)) {
                // Agregar la condición WHERE para actualizar el recorrido específico en la tabla 'recorrido'
                $consultaUpdateRecorrido .= " WHERE id_recorrido = $id_recorrido";

                // Ejecutar la consulta de actualización en la tabla 'recorrido'
                if ($conexion->query($consultaUpdateRecorrido) === TRUE) {
                    echo "Recorrido actualizado correctamente.";
                } else {
                    echo "Error al actualizar el recorrido: " . $conexion->error;
                }
            } else {
                // Mostrar mensaje si no se realizaron cambios
                echo "El recorrido se ha guardado sin cambios.";
            }

            // Consulta SQL de actualización en la tabla 'lote' para el campo 'estado' y 'departamento_destino'
            $consultaUpdateLote = "UPDATE lote SET";

            if (!empty($departamento_destino)) {
                $consultaUpdateLote .= " departamento_destino = '$departamento_destino',";
            }

            if (!empty($estado)) {
                $consultaUpdateLote .= " estado = '$estado',";
            }

            // Eliminar la coma final si se agregaron campos a la consulta
            if (substr($consultaUpdateLote, -1) == ',') {
                $consultaUpdateLote = substr($consultaUpdateLote, 0, -1);
            }

            $consultaUpdateLote .= " WHERE id_lote IN (SELECT id_lote FROM recorrido WHERE id_recorrido = $id_recorrido)";

            // Ejecutar la consulta de actualización en la tabla 'lote'
            if ($conexion->query($consultaUpdateLote) === TRUE) {
                echo "Estado del recorrido actualizado correctamente.";
            } else {
                echo "Error al actualizar el estado del lote: " . $conexion->error;
            }
        }
    } else {
        // Manejar el caso en el que no se proporcionaron los valores necesarios
        die("Error: Los valores de id y almacen no se proporcionaron correctamente.");
    }

    // COONSIGO LA INFORMACION DEL LOTE
    $consulta = "SELECT R.id_recorrido, R.matricula AS matricula_camion, PP.id_almacen, A.departamento AS departamento_almacen 
    FROM RECORRIDO R 
    INNER JOIN PASA_POR PP ON R.id_recorrido = PP.id_recorrido 
    INNER JOIN ALMACEN A ON PP.id_almacen = A.id_almacen;";
    $resultado = $conexion->query($consulta);

    if ($resultado && $resultado->num_rows > 0) {
        $recorrido = $resultado->fetch_assoc();
    } else {
        die("Error: El recorrido no existe o no se encontró.");
    }
    ?>


    <body>
        <h1>Gestion de Recorridos- <?php echo $almacen; ?></h1>
        <div class="modiLote">
           


            <?php



            // PARTE DE AGREGAR PAQUETE AL LOTE

            // Verificar si se ha enviado el formulario de "Agregar al lote"
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["agregar_lote_recorridos"])) {
                // Obtener el ID del paquete y el ID del lote
                $departamentoDestino = $_POST["departamento_destino"];
                $id_recorrido = $_POST["id"];
                $id_lote = $_POST["id_lote"];

                // Realizar la consulta de actualización
                $consultaUpdateLoteRecorrido = "UPDATE lote SET id_recorrido = $id_recorrido WHERE id_lote = $id_lote";

                // Ejecutar la consulta
                $resultadoUpdateLoteRecorrido = $conexion->query($consultaUpdateLoteRecorrido);

                if ($resultadoUpdateLoteRecorrido) {
                    // La actualización se realizó con éxito
                    echo "Lote agregado al recorrido correctamente.";
                    // Redireccionar a la misma página
                    header("Location: modificarRecorridos.php?id=$id_recorrido&almacen=$almacen");
                    exit(); // Asegurarse de que se detenga la ejecución del script
                }
            }



            //PARTE DE SACAR LOTE DEL RECORRIDO

            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["sacar_lote_Recorridos"])) {
                // Obtener el ID del paquete y el ID del lote
                $departamentoDestino = $_POST["departamento_destino"];
                $id_recorrido = $_POST["id"];
                $id_lote = $_POST["id_lote"];

                // Realizar la consulta de actualización para establecer id_lote en NULL
                $consultaUpdateRecorridoLote = "UPDATE lote SET id_recorrido = NULL WHERE id_lote = $id_lote";

                // Ejecutar la consulta
                $resultadoUpdateRecorridoLote = $conexion->query($consultaUpdateRecorridoLote);

                if ($resultadoUpdateRecorridoLote) {
                    // La actualización se realizó con éxito
                    echo "Lote sacado del recorrido correctamente.";
                    // Redireccionar a la misma página
                    header("Location: modificarRecorridos.php?id=$id_recorrido&almacen=$almacen");
                    exit(); // Asegurarse de que se detenga la ejecución del script
                }
            }


            // Obtener todos los lotes disponibles en la almacen

            $consultaLot = ""; // Inicializamos la consulta del los lotes

            $consultaLot = "SELECT id_lote, departamento_destino FROM lote WHERE id_recorrido IS NULL ";

            $resultadosConsultaLot = $conexion->query($consultaLot);


            ?>



            <form id="paqueteLote" action="modificarRecorridos.php" method="post">

                <div class="tablaDivPaq">
                    <table id="lotesDisponibles" border="1">
                        <thead>
                            <tr>
                                <th colspan="4">Lotes disponibles en el almacén</th>
                            </tr>
                            <tr>
                                <th>Numero Lote</th>
                                <th>Destino Lote</th>
                                <th>Agregar</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            // Mientras haya paquetes disponibles en el almacén
                            while ($filaConsultaLot = $resultadosConsultaLot->fetch_assoc()) {
                                $id_lote = $filaConsultaLot["id_lote"];
                                $departamentoDestino = $filaConsultaLot["departamento_destino"];


                                echo "<tr>";
                                echo "<td>$id_lote</td>";
                                echo "<td>$departamentoDestino</td>";
                                echo '<td>
                                 <form id="form_agregar_' . $id_lote . '" action="modificarRecorridos.php" method="post">
                                     <input type="hidden" name="almacen" value="' . $almacen . '">
                                     <input type="hidden" name="id_lote" value="' . $id_lote . '"> 
                                     <input type="hidden" name="id" value="' . $id_recorrido . '">
                                     <button class="Agregar" type="submit" name="agregar_lote_recorridos">Agregar</button>
                                 </form>
                             </td>';
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
            </form>



            <form id="lotePaquete" action="modificarRecorridos.php" method="post">

                <?php
                $consultaRecorridoLote = "SELECT id_lote, departamento_destino FROM lote WHERE id_recorrido = $id_recorrido";
                $resultadosRecorridoLote = $conexion->query($consultaRecorridoLote);
                ?>

                <table id="lotesRecorrido" border="1">
                    <thead>
                        <tr>
                            <th colspan="4">Lotes dentro del Recorrido - <?php echo $id_recorrido; ?></th>
                        </tr>
                        <tr>
                            <th>Numero lote</th>
                            <th>Destino lote</th>
                            <th>Sacar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Mientras haya paquetes dentro del lote
                        while ($filaRecorridoLote = $resultadosRecorridoLote->fetch_assoc()) {
                            $id_lote = $filaRecorridoLote["id_lote"];
                            $departamentoDestino = $filaRecorridoLote["departamento_destino"];

                            echo "<tr>";
                            echo "<td> $id_lote </td>";
                            echo "<td>$departamentoDestino</td>";

                            echo '<td>
        <form id="form_sacar_' . $id_lote . '" action="modificarRecorridos.php" method="post">
        <input type="hidden" name="almacen" value="' . $almacen . '">
        <input type="hidden" name="id_lote" value="' . $id_lote . '"> 
        <input type="hidden" name="id" value="' . $id_recorrido . '">
            <button class="Sacar" type="submit" name="sacar_lote_Recorridos">Sacar</button>
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

            <input type="button" value="Volver" onclick="window.location.href='datosRecorrido.php?almacen=<?php echo $almacen; ?>'">

        </div>

        <script src="script.js"></script>
    </body>

</html>