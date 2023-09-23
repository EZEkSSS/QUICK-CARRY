<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Camionero</title>
    <link rel="stylesheet" href="style.css">
</head>
<header>

    <div class="logo">
        <a href="index.php"><img src="qc.png" alt="qc"></a>
        <h1>Quick Carry</h1>
    </div>
</header>

<body>
    <?php $ci = isset($_GET['ci']) ? $_GET['ci'] : ''; ?>

    <h1>
        CI:
        <?php echo $ci; ?>
    </h1>
    <div class="botones">
        <form>
            <input type="button" value="Recorridos pendientes"
                onclick="window.location.href='recorridos.php?ci=<?php echo $ci ?>'">
            <input type="button" value="Cerrar sesión" id="btn-logout">
        </form>
    </div>
    <script src="script.js"></script>
</body>

</html>