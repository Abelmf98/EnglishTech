<?php
/**
     * @file comprobar.php
     * Archivo para comprobar el inicio de sesión.
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
            <a href="#" class="nav">Sobre Nosotros</a>
        </nav>
    </header>
    <main>
    <?php
    /**
     * Necesitaremos el archivo conexion bd y el archivos de metodos mysqli
     */
        require_once 'conexionbd.php';
        require_once 'metodos.php';

        /**
         * Instanciamos un objeto de la clase metodos
         */
        $objResultado = new metodos();

        /**
         * Creamos la variable consulta para escribir la consulta que 
         * realizaremos en la base de datos
         */
        $consulta = "
                SELECT *
                FROM usuario
                WHERE nombre ='".$_POST["nombre"]."' && contrasenia ='".$_POST["password"]."';
            ";
        /**
         * Llamamos al metodo que contienen el query para realizar la consulta escrita
         */
        $objResultado->realizarconsulta($consulta);

        /**
         * Comprobamos si me devuelve alguna fila
         */
        if($objResultado->comprobarnumrow()){
            /**
             * Método para iniciar la sesión
             */
            session_start();
            $_SESSION["nombre"] = $_POST["nombre"];
            $_SESSION["contrasenia"] = $_POST["password"];
            echo '<h3 id="true">Se ha iniciado sesion correctamente al usuario '.$_SESSION["nombre"].'</h3>';
            echo '<h4><a class="d" href="index.html">Volver a inicio</a></h4>';
            /**
             * Método para cerrar la sesión
             */
            session_destroy();
        }
        else
       {
           echo '<h3 id="false">No se ha podidio iniciar sesion al usuario '.$_POST["nombre"].',  ya que el usuario no existe o los datos no son correctos</h3><br>';
           echo '<h4><a href="login.php">Volver al login</a></h4>';
       }    
    ?>
    </main>
    <footer class="pie-login">
            <h5><a>Contáctanos - 924 00 22 77</a></h5>
            <h5><a>Aviso Legal</a></h5>
            <h5><a>Política de Privacidad</a></h5>
        </footer>
</body>
</html>