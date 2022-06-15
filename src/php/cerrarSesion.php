<?php
/**
     * @file cerrarSesion.php
     * Archivo para cerrar la sesión iniciada.
     * @author Abel Mansilla Felipe (amansillafelipe.guadalupe@alumnado.fundacionloyola.net)
     * @license GPLv3 2022.
     */
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilo.css">
    <title>Cerrar sesion</title>
</head>
<body>
<header>
        <a href="#" class="logo">
            <img src="../img/logo.png" alt="logo">
            <h2 class="nombre">EnglishTech</h2>
        </a>
        <nav>
                <a href="index.php" class="nav">Inicio</a>
        </nav>
</header>
<?php
session_start();
/**
 * Llamamos al método cerrar sesión y mostramos un mensaje de confirmación
 */
if (session_destroy()) {
    echo "<h3>Sesión cerrada correctamente</h3>";
} else {
    echo "Error al cerrar la sesión";
}
echo '<h3><a class="true" href="index.php">Volver a inicio</a></h3>';
?>
<footer class="pie-juego">
            <h5><a>Contáctanos - 924 00 22 77</a></h5>
            <h5><a>Aviso Legal</a></h5>
            <h5><a>Política de Privacidad</a></h5>
    </footer>
</body>
</html>