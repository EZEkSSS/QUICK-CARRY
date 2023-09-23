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
    <title>ALMACEN</title>
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
        <?php

        if ($almacen === "Montevideo") {
        ?>
            <li><a href="altaPaquete.php?almacen=<?php echo $almacen; ?>">Alta de Paquetes</a></li>
            <li><a href="gestionLotes.php?almacen=<?php echo $almacen; ?>">Gestión de Lotes</a></li>
            <li><a href="altaRecorrido.php?almacen=<?php echo $almacen; ?>">Alta de Recorridos</a></li>
            <li><a href="datosRecorrido.php?almacen=<?php echo $almacen; ?>">Alta de Recorridos</a></li>

        <?php
        }
        ?>

        <li><a href="datosPaquete.php?almacen=<?php echo $almacen; ?>">Ver paquetes</a></li>
    </ul>

</header>

<body>

    <h1>ALMACEN - <?php echo $almacen; ?></h1>

    <hr class="raya">

    <div class="botones">
        <form>
            <?php
            if ($almacen === "Montevideo") {
                echo '<input type="button" value="Alta de paquetes" onclick="window.location.href=\'altaPaquete.php?almacen=' . $almacen . '\'" />';
                echo '<input type="button" value="Gestión Lotes" onclick="window.location.href=\'gestionLotes.php?almacen=' . $almacen . '\'" />';
                echo '<input type="button" value="Alta Recorridos" onclick="window.location.href=\'altaRecorrido.php?almacen=' . $almacen . '\'" />';
                echo '<input type="button" value="Datos Recorridos" onclick="window.location.href=\'datosRecorrido.php?almacen=' . $almacen . '\'" />';
            }

            ?>
            <input type="button" value="Ver paquetes" onclick="window.location.href='datosPaquete.php?almacen=<?php echo $almacen; ?>'">

            <input type="button" value="Cerrar sesión" id="btn-logout">
        </form>
    </div>

    <script src="script.js"></script>
</body>

</html>