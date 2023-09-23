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
    <title>LOTES</title>
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

    <h1>Gestion de Recorridos - <?php echo $almacen; ?></h1>


    <?php
    $conexion = new mysqli("localhost", "root", "", "quickcarry");

    // Obtener todos los recorridos
    $consulta = "SELECT R.id_recorrido, R.matricula AS matricula_camion, PP.id_almacen, A.departamento AS departamento_almacen 
    FROM RECORRIDO R 
    INNER JOIN PASA_POR PP ON R.id_recorrido = PP.id_recorrido 
    INNER JOIN ALMACEN A ON PP.id_almacen = A.id_almacen;";
    $resultados = $conexion->query($consulta);


    if (!$resultados) {
        die("Error en la consulta: " . $conexion->error);
    }
    ?>
    <div class="tablas">
        <div class="altaLote">
            <h2>Alta de Recorridos - <?php echo $almacen; ?></h2>
            <form action="gestionRecorridos.php" method="post">

                <label>Destino Recorridos:</label>
                <div class="columnasDepartamentos">
                    <!-- Primera columna -->
                    <div class="columnas">
                        <input type="checkbox" id="artigas" name="destinos[]" value="6">
                        <label for="artigas">Artigas</label><br>

                        <input type="checkbox" id="canelones" name="destinos[]" value="3">
                        <label for="canelones">Canelones</label><br>

                        <input type="checkbox" id="cerro_largo" name="destinos[]" value="9">
                        <label for="cerro_largo">Cerro Largo</label><br>

                        <input type="checkbox" id="colonia" name="destinos[]" value="8">
                        <label for="colonia">Colonia</label><br>

                        <input type="checkbox" id="durazno" name="destinos[]" value="10">
                        <label for="durazno">Durazno</label><br>
                    </div>

                    <!-- Segunda columna -->
                    <div class="columnas">
                        <input type="checkbox" id="flores" name="destinos[]" value="11">
                        <label for="flores">Flores</label><br>

                        <input type="checkbox" id="florida" name="destinos[]" value="19">
                        <label for="florida">Florida</label><br>

                        <input type="checkbox" id="lavalleja" name="destinos[]" value="12">
                        <label for="lavalleja">Lavalleja</label><br>

                        <input type="checkbox" id="maldonado" name="destinos[]" value="4">
                        <label for="maldonado">Maldonado</label><br>

                        <input type="checkbox" id="montevideo" name="destinos[]" value="1">
                        <label for="montevideo">Montevideo</label><br>
                    </div>

                    <!-- Tercera columna -->
                    <div class="columnas">
                        <input type="checkbox" id="paysandu" name="destinos[]" value="7">
                        <label for="paysandu">Paysandú</label><br>

                        <input type="checkbox" id="rio_negro" name="destinos[]" value="13">
                        <label for="rio_negro">Río Negro</label><br>

                        <input type="checkbox" id="rivera" name="destinos[]" value="14">
                        <label for="rivera">Rivera</label><br>

                        <input type="checkbox" id="rocha" name="destinos[]" value="5">
                        <label for="rocha">Rocha</label><br>

                        <input type="checkbox" id="salto" name="destinos[]" value="15">
                        <label for="salto">Salto</label><br>
                    </div>

                    <!-- Cuarta columna -->
                    <div class="columnas">
                        <input type="checkbox" id="san_jose" name="destinos[]" value="16">
                        <label for="san_jose">San José</label><br>

                        <input type="checkbox" id="soriano" name="destinos[]" value="17">
                        <label for="soriano">Soriano</label><br>

                        <input type="checkbox" id="tacuarembo" name="destinos[]" value="2">
                        <label for="tacuarembo">Tacuarembó</label><br>

                        <input type="checkbox" id="treinta_y_tres" value="18">
                        <label for="treinta_y_tres">Treinta y Tres</label><br>
                    </div>
                </div>

                <label for="matriculaCamion">Matricula camion:</label>
                <select name="matriculaCamion" id="matriculaCamion" required>
                    <option value="">Seleccione el camion</option>
                    <?php
                    // Consulta SQL para obtener las matrículas de los camiones
                    $consultaMatriculas = "SELECT matricula FROM camion";
                    $resultado = $conexion->query($consultaMatriculas);

                    if ($resultado->num_rows > 0) {
                        // Generar opciones del select
                        while ($row = $resultado->fetch_assoc()) {
                            echo '<option value="' . $row['matricula'] . '">' . $row['matricula'] . '</option>';
                        }
                    } else {
                        echo "No se encontraron camiones en la base de datos.";
                    }
                    ?>
                </select>

                
                <input type="submit" value="Agregar Recorrido">
            </form>
            <?php


            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $almacen = isset($_GET['almacen']) ? $_GET['almacen'] : '';


                $matricula = isset($_POST["matriculaCamion"]) ? $_POST["matriculaCamion"] : '';
                echo "Matrícula a insertar: " . $matricula; // Agrega esta línea para depuración
                // Insertar el recorrido en la tabla recorrido
                $consultaInsertRecorrido = "INSERT INTO recorrido (matricula) VALUES ('$matricula')";
                $resultadoInsertRecorrido = $conexion->query($consultaInsertRecorrido);
                if ($resultadoInsertRecorrido) {
                    // Obtener el id del recorrido recién insertado
                    $id_recorrido = $conexion->insert_id;

                    // Obtener la lista de destinos seleccionados desde el formulario
                    $destinos = isset($_POST["destinos"]) ? $_POST["destinos"] : [];

                    // Insertar los destinos seleccionados en la tabla pasa_por
                    foreach ($destinos as $destino) {
                        $consultaInsertPasaPor = "INSERT INTO pasa_por (id_recorrido, id_almacen) VALUES ($id_recorrido, '$destino')";
                        $resultadoInsertPasaPor = $conexion->query($consultaInsertPasaPor);

                        if (!$resultadoInsertPasaPor) {
                            echo "Error al insertar destino en pasa_por: " . $conexion->error;
                        }
                    }
                    // Redirigir de vuelta a la página de gestión de recorridos
                     header("Location: gestionRecorridos.php?almacen=$almacen");
                    exit;
                } else {
                    echo "Error al agregar el recorrido: " . $conexion->error;
                }
            }
            ?>





        </div>

        <div class="tablaDivLot">

            <table border="1">
                <thead>
                    <tr>
                        <th>Id Recorridos</th>
                        <th>Destino Recorridos</th>
                        <th>Vehiculo</th>
                        <th>Modificar </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($fila = $resultados->fetch_assoc()) {
                        $id_recorrido = $fila["id_recorrido"];
                        $departamento_almacen = $fila["departamento_almacen"];
                        $matricula = $fila["matricula_camion"];

                        echo "<tr>";
                        echo "<td>" . $id_recorrido . "</td>";
                        echo "<td>" . $departamento_almacen . "</td>";
                        echo "<td>" . $matricula . "</td>";
                        echo "<td><form action='modificarRecorridos.php' method='get'>
                        <input type='hidden' name='id' value='$id_recorrido'>
                        <input type='hidden' name='almacen' value='$almacen'>
                        <button class='boton-modificar'>Modificar</button>
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