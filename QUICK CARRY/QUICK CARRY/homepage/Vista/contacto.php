<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Formulario de correo automático</title>
    <link rel="icon" href="qc.png">
    <link rel="stylesheet" href="style.css">
</head>
<header>

    <div class="logo">
        <a href="/QUICK CARRY/homepage/index.html"><img src="qc.png" alt="qc"></a>
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

<section class="contacto">
       
<div class="formulario">
    <h1>Formulario de correo automático</h1>
    <?php
    if (isset($_POST['submit'])) {
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $telefono = $_POST['telefono'];
        $comentario = $_POST['comentario'];

        $to = 'ezelevla@gmail.com'; //Mail al que se envia el mail

        $subject = 'Nuevo mensaje del formulario de contacto';
        $message = "Nombre: $nombre\n\n";
        $message .= "Correo electrónico: $correo\n\n";
        $message .= "Número de teléfono: $telefono\n\n";
        $message .= "Comentario:\n$comentario\n";

        $headers = "From: $correo";

        try {
            if (mail($to, $subject, $message, $headers)) {
                echo "<p>Correo enviado exitosamente.</p>";
            } else {
                echo "<p>Error al enviar el correo.</p>";
            }
        } catch (Exception $e) {
            echo "<p>Error al enviar el correo: " . $e->getMessage() . "</p>";
        }
    }
    ?>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="text" id="nombre" name="nombre" placeholder="Nombre:" required><br><br>
        <input type="email" id="correo" name="correo" placeholder="Correo electrónico:" required><br><br>
        <input type="text" id="telefono" name="telefono" placeholder="Número de teléfono:"><br><br>
        <textarea id="comentario" name="comentario" placeholder="Comentario:" required></textarea><br><br>
        <input type="submit" name="submit" value="Enviar">
        <input type="button" value="Volver" onclick="window.location.href='/QUICK%20CARRY/homepage/Vista/index.php'">
    </form>
</div>

</section>


    <footer>
        <div class="footer-sections">
            <div class="idioma">
                <h3>Seleccionar idioma</h3>
                <a href="">Español(España)</a>
                <br>
                <a href="">Inglés(US)</a>
            </div>
            <div class="informacion">
                <h3>Quickcarry</h3>
                <p>Telefono: xxxx xxxx</p>
                <p>Direccion: xxxx xxxx</p>
                <p>Contacto: xxxx xxxx</p>
                <p>Whatsapp: xxx xxx xxx</p>
            </div>
            <div class="redes">
                <h3>Redes Sociales</h3>
                <a href="#"><img src="wpp.png" alt="wpp"></a>
                <a href="#"><img src="ig.png" alt="ig"></a>
                <br>
                <a href="#"><img src="fb.png" alt="fb"></a>
                <a href="#"><img src="yt.png" alt="yt"></a>
            </div>
        </div>
        <div class="copy">
            <small>&copy; 2023 <b>Quickcarry</b> - Todos los derechos reservados</small>
        </div>
    </footer>
    <script src="script.js"></script>
</body>

</html>