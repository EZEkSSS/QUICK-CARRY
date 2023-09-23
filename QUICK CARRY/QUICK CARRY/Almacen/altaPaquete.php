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
    <title>Alta paquete</title>
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
    // Crear la conexión a la base de datos
    $conexion = new mysqli("localhost", "root", "", "quickcarry");

    // Verificar si hay errores en la conexión
    if ($conexion->connect_error) {
        die("Error en la conexión a la base de datos: " . $conexion->connect_error);
    }
    ?>

    <h1>Alta paquete- <?php echo $almacen; ?></h1>
    <form action="altaPaquete.php?almacen=<?php echo $almacen; ?>" method="get">
        <div class="formularioAltaPaquete">
            <b>Peso</b>
            <select name="peso" id="peso" required>
                <option value="">Seleccione un peso</option>
                <option value="0-5">0-5 Kg</option>
                <option value="5-10">5-10 Kg</option>
                <option value="10-20">10-20 Kg</option>
                <option value="20-30">20-30 Kg</option>
                <option value="30+">30+ Kg</option>
            </select>
            <br><br>
            <b>Tamaño:</b>
            <select name="tamaño" id="tamaño" required>
                <option value="">Seleccione un tamaño</option>
                <option value="Grande">Grande</option>
                <option value="Mediano">Mediano</option>
                <option value="Chico">Chico</option>
            </select>
            <br><br>
            <b>Tipo de entrega</b>
            <select name="tipo_entrega" id="tipo_entrega" required>
                <option value="">Seleccione una entrega</option>
                <option value="Almacen">Almacen</option>
                <option value="Final">Final</option>
            </select>
            <br><br>


            <b>Nombre destinatario:</b> <input type="text" name="nombre_destinatario" required> <br><br>
            <b>Mail destinatario:</b> <input type="text" name="email_destinatario" required> <br><br>
            <b>Departamento destinatario:</b>
            <select name="departamento_destinatario" id="departamento_destinatario" required>
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
            <br><br>
            <b>Ciudad destinatario:</b>
            <select name="ciudad_destinatario" id="ciudad_destinatario" required>
                <option value="">Seleccione una ciudad</option>
            </select>
            <br><br>
            <b>Calle destinatario:</b> <input type="text" name="calle_destinatario" required> <br><br>
            <b>Numero Puerta destinatario:</b> <input type="text" name="numero_puerta_destinatario" required> <br><br>

            <input type="hidden" name="almacen" value="<?php echo $almacen; ?>">
            <input type="submit" value="Añadir Paquete">
        </div>
        <input type="button" value="Volver" onclick="window.location.href='index.php?almacen=<?php echo $almacen; ?>'">

    </form>

    <?php
    /*INGRESO A TABLA PAQUETE*/
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $peso = $_POST["peso"];
        $tamaño = $_POST["tamaño"];
        $tipo_entrega = $_POST["tipo_entrega"];
        $fecha_ingreso = date("Y-m-d"); // Usar el formato de fecha de MySQL
        $hora_ingreso = date("H:i:s"); // Usar el formato de hora de MySQL


        $departamento_destinatario = $_POST["departamento_destinatario"];
        $ciudad_destinatario = $_POST["ciudad_destinatario"];
        $calle_destinatario = $_POST["calle_destinatario"];
        $numero_puerta_destinatario = $_POST["numero_puerta_destinatario"];
        $nombre_destinatario = $_POST["nombre_destinatario"];
        $email_destinatario = $_POST["email_destinatario"];

        $estado = "Ingresado almacen";


        // Asegúrate de que la tabla paquetes tenga las columnas correspondientes en el mismo orden.
        $sentencia = "INSERT INTO paquete (`peso`, `tamaño`, `tipo_entrega`, `fecha_ingreso`, `hora_ingreso`, `fecha_envio`, `hora_envio`, `fecha_entrega`, `hora_entrega`, `departamento_destinatario`, `ciudad_destinatario`, `calle_destinatario`, `numero_puerta_destinatario`, `nombre_destinatario`, `email_destinatario`, `estado`) 
        VALUES ('$peso', '$tamaño', '$tipo_entrega', '$fecha_ingreso', '$hora_ingreso', NULL, NULL, NULL, NULL, '$departamento_destinatario', '$ciudad_destinatario', '$calle_destinatario', '$numero_puerta_destinatario', '$nombre_destinatario', '$email_destinatario', '$estado')";

        if ($conexion->query($sentencia) === TRUE) {
            echo "Paquete añadido exitosamente";
        } else {
            echo "Error al añadir el Paquete: " . $conexion->error;
        }
    }




    ?>


    <script>
        // Datos de las ciudades para cada departamento
        const ciudadesPorDepartamento = {
            "": [], // Opción vacía
            "Artigas": ["Artigas", "Bella Unión"],
            "Canelones": ["Canelones", "Santa Lucía", "Las Piedras", "Pando", "La Paz", "Toledo"],
            "Cerro Largo": ["Melo", "Aceguá"],
            "Colonia": ["Colonia del Sacramento", "Carmelo", "Juan Lacaze", "Nueva Helvecia"],
            "Durazno": ["Durazno", "Sarandí del Yí"],
            "Flores": ["Trinidad", "Ismael Cortinas"],
            "Florida": ["Florida"],
            "Lavalleja": ["Minas"],
            "Maldonado": ["Maldonado", "Punta del Este", "San Carlos", "Pan de Azúcar"],
            "Montevideo": ["Montevideo"],
            "Paysandú": ["Paysandú", "Guichón"],
            "Río Negro": ["Fray Bentos", "Young"],
            "Rivera": ["Rivera", "Tranqueras"],
            "Rocha": ["Rocha", "Chuy"],
            "Salto": ["Salto"],
            "San José": ["San José de Mayo"],
            "Soriano": ["Mercedes", "Dolores"],
            "Tacuarembó": ["Tacuarembó", "Paso de los Toros"],
            "Treinta y Tres": ["Treinta y Tres"],
        };

        // Obtener los elementos select
        const departamentoDestinatarioSelect = document.getElementById("departamento_destinatario");
        const ciudadDestinatarioSelect = document.getElementById("ciudad_destinatario");

        // Función para actualizar las opciones del select de ciudades
        function actualizarCiudades(selectDepartamento, selectCiudad) {
            const departamentoSeleccionado = selectDepartamento.value;
            const ciudades = ciudadesPorDepartamento[departamentoSeleccionado];

            // Limpiar opciones actuales y agregar la opción vacía
            selectCiudad.innerHTML = "<option value=''>Seleccione una ciudad</option>";

            // Agregar las nuevas opciones
            ciudades.forEach(ciudad => {
                const option = document.createElement("option");
                option.text = ciudad;
                selectCiudad.add(option);
            });

            // Deshabilitar selección de la opción vacía si corresponde
            selectCiudad.selectedIndex = departamentoSeleccionado === "" ? -1 : 0;
        }

        // Agregar eventos para actualizar las ciudades cuando se seleccione un departamento
        departamentoDestinatarioSelect.addEventListener("change", () => {
            actualizarCiudades(departamentoDestinatarioSelect, ciudadDestinatarioSelect);
        });

        // Inicializar las ciudades para el primer valor seleccionado (por defecto)
        actualizarCiudades(departamentoDestinatarioSelect, ciudadDestinatarioSelect);
    </script>
</body>

</html>