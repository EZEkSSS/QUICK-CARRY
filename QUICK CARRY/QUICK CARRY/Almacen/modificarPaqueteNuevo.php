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
    <title>Modificar Paquete</title>
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
    $conexion = new mysqli("localhost", "root", "", "quickcarry");

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"]) && isset($_GET["almacen"])) {
        $id = $_GET["id"];
        $almacen = $_GET["almacen"];


        // Obtener todos los paquetes
        $consulta = "SELECT id_paquete, nombre_destinatario, email_destinatario, departamento_destinatario, ciudad_destinatario, calle_destinatario, numero_puerta_destinatario
FROM paquete
WHERE id_paquete = $id";
        $resultados = $conexion->query($consulta);
        $paquete = $resultados->fetch_assoc();
    }

    // Actualizar datos del paquete seleccionado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST["id"];
        $nombreDestinatario = $_POST["nombre_destinatario"];
        $mailDestinatario = $_POST["email_destinatario"];
        $departamentoDestinatario = $_POST["departamento_destinatario"];
        $ciudadDestinatario = $_POST["ciudad_destinatario"];
        $calleDestinatario = $_POST["calle_destinatario"];
        $numeroPuertaDestinatario = $_POST["numero_puerta_destinatario"];
   
        $almacen = $_POST["almacen"];

        // Actualizar los datos en la base de datos
        $sentencia = "UPDATE paquete SET  nombre_destinatario = '$nombreDestinatario', email_destinatario = '$mailDestinatario', departamento_destinatario = '$departamentoDestinatario', ciudad_destinatario = '$ciudadDestinatario', calle_destinatario = '$calleDestinatario', numero_puerta_destinatario = '$numeroPuertaDestinatario' WHERE id_paquete = $id";
        if ($conexion->query($sentencia) === TRUE) {
            $mensaje = "Paquete modificado exitosamente";
        } else {
            $mensaje = "Error al modificar el paquete: " . $conexion->error;
        }
    }
    ?>

    <h1>Modificar Paquete - <?php echo $id . ' ' . $almacen; ?></h1>
    <?php if (isset($mensaje)) : ?>
        <p>
            <?php echo $mensaje; ?>
        </p>
    <?php endif; ?>
    <div class="formulario">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <?php if (isset($paquete)) : ?>
                <input type="hidden" name="id" value="<?php echo $paquete['id_paquete']; ?>">
                <input type="hidden" name="almacen" value="<?php echo $almacen; ?>">


                <label for="nombre_destinatario">Nombre Destinatario:</label>
                <input type="text" id="nombre_destinatario" name="nombre_destinatario" value="<?php echo $paquete['nombre_destinatario']; ?>"><br><br>
                <label for="email_destinatario">Email Destinatario:</label>
                <input type="text" id="email_destinatario" name="email_destinatario" value="<?php echo $paquete['email_destinatario']; ?>"><br><br>
                <label for="departamento_destinatario">Departamento Destinatario:</label>
                <select name="departamento_destinatario" id="departamento_destinatario">
                    <option value="" disabled selected><?php echo $paquete['departamento_destinatario']; ?></option>
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
                </select><br><br>
                <label for="ciudad_destinatario">Ciudad Destinatario:</label>
                <select name="ciudad_destinatario" id="ciudad_destinatario" required>
                    <option value="<?php echo $paquete['ciudad_destinatario']; ?>" selected><?php echo $paquete['ciudad_destinatario']; ?></option>

                    <option value="">Seleccione una ciudad</option>
                </select><br><br>
                <label for="calle_destinatario">Calle Destinatario:</label>
                <input type="text" id="calle_destinatario" name="calle_destinatario" value="<?php echo $paquete['calle_destinatario']; ?>"><br><br>
                <label for="numero_puerta_destinatario">numero Puerta Destinatario:</label>
                <input type="text" id="numero_puerta_destinatario" name="numero_puerta_destinatario" value="<?php echo $paquete['numero_puerta_destinatario']; ?>"><br><br>

                <input type="submit" value="Guardar Cambios">
            <?php endif; ?>
        </form>
    </div>

    <div class="volver">
        <input type="button" value="Volver" onclick="window.location.href='datosPaquete.php?almacen=<?php echo $almacen; ?>'">
    </div>

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
            const ciudades = ciudadesPorDepartamento[departamentoSeleccionado] || [];

            // Limpiar opciones actuales y agregar la opción vacía
            selectCiudad.innerHTML = "<option value=''>Seleccione una ciudad</option>";

            // Agregar las nuevas opciones
            ciudades.forEach(ciudad => {
                const option = document.createElement("option");
                option.text = ciudad;
                option.value = ciudad; // Asignar el valor de la ciudad
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