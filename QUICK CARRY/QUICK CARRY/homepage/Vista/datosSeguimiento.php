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
    <title>Seguimiento Paquete</title>
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
            <li><a href="/QUICK CARRY/API AUTENTICACION/Vista/index.html">Inicio Sesion</a></li>
            <li><a href="/QUICK CARRY/homepage/Vista/contacto.php">Contacto</a></li>
            <li><a href="/QUICK CARRY/homepage/Vista/sobreNosotros.html">Sobre Nosotros</a></li>
        </ul>

</header>

<body>
    <section class="vistaPaquete">

        <div class="divGeneral">
            <div class="tablaSeguimiento">
                <?php
                include_once '../Controlador/controlador.php';
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $id_paquete = $_POST["id_paquete"];

                    $paqueteController = new PaqueteController();
                    $info_paquete = $paqueteController->getEstadoPaquete($id_paquete);

                    echo "<h2>Resultado de búsqueda</h2>";

                    if (isset($info_paquete['error'])) {
                        echo "<p>{$info_paquete['error']}</p>"; // Mostrar mensaje de error
                    } else {
                        echo "<table border>";
                        echo "<tr><td><p>Numero de Rastreo:</p></td><td>" . $id_paquete . "</td></tr>";;
                        echo "<tr><td><p>Estado:</p></td><td>" . (isset($info_paquete['estado']) ? $info_paquete['estado'] : 'N/A') . "</td></tr>";
                        echo "<tr><td><p>Peso:</p></td><td>" . (isset($info_paquete['peso']) ? $info_paquete['peso'] : 'N/A') . "</td></tr>";
                        echo "<tr><td><p>Tamaño:</p></td><td>" . (isset($info_paquete['tamaño']) ? $info_paquete['tamaño'] : 'N/A') . "</td></tr>";
                        echo "<tr><td><p>Tipo de Entrega:</p></td><td>" . (isset($info_paquete['tipo_entrega']) ? $info_paquete['tipo_entrega'] : 'N/A') . "</td></tr>";
                        echo "<tr><td><p>Departamento Destinatario:</p></td><td>" . (isset($info_paquete['departamento_destinatario']) ? $info_paquete['departamento_destinatario'] : 'N/A') . "</td></tr>";
                        echo "<tr><td><p>Ciudad Destinatario:</p></td><td>" . (isset($info_paquete['ciudad_destinatario']) ? $info_paquete['ciudad_destinatario'] : 'N/A') . "</td></tr>";
                        echo "</table>";
                    }
                }
                ?>
     <input type="button" value="Volver" onclick="window.location.href='/QUICK%20CARRY/homepage/Vista/index.php'">
            </div>
        </div>
        <script src="script.js"></script>
    </section>
</body>

</html>