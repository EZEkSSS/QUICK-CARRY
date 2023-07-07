<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="qc.png">
    <title>ADMIN</title>
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


    <h1>ADMIN</h1>

    <hr class="raya">

    <div class="botones">
        <form>
            <input type="button" value="Control de usuarios" onclick="window.location.href='controlUsuarios.php'">
            <input type="button" value="Control de camiones" onclick="window.location.href='controlCamiones.php'">
            <input type="button" value="Control de almacenes" onclick="window.location.href='controlAlmacenes.php'">
            <input type="button" value="Cerrar sesión" id="btn-logout">

        </form>
    </div>

    <script src="script.js"></script>
</body>

</html>