<?php
/**
     * @file login.php
     * Archivo de login.
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
    <title>EnglishTech</title>
</head>
<body>
    <header>
        <a href="#" class="logo">
            <img src="../img/logo.png" alt="logo">
            <h2 class="nombre">EnglishTech</h2>
        </a>
        <nav>
            <a href="index.html" class="nav">Inicio</a>
        </nav>
    </header>
    <main>
        <?php
        /**
         * Necesitaremos el archivo conexion de la base de datos y el archivo de metodos mysqli
         */
            require_once 'conexionbd.php';
            require_once 'metodos.php';

            /**
             * Formulario de login
             */
            echo '
                <form class="login" action="comprobar.php" method="POST">
                    <h1>Inicio de Sesión</h1><br>
                    <label>Introduce el usuario</label>
                    <input type="text" name="nombre"/><br>
                    <label>Introduce la contraseña</label>
                    <input type="password" name="password"/><br>
                    <input type="submit" name="Enviar">
                <form>
            '
        ?>
    </main>
    <footer>
        <h5><a>Contáctanos - 924 00 22 77</a></h5>
        <h5><a>Aviso Legal</a></h5>
        <h5><a>Política de Privacidad</a></h5>
    </footer>
</body>
</html>