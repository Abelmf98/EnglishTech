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
            <a href="index.php" class="nav">Inicio</a>
        </nav>
    </header>
    <main>
    <?php
    /**
     * Necesitaremos el archivo conexion bd y el archivos de metodos mysqli
     */
    session_start();
    require_once 'metodos.php';

    /**
     * Objeto de la clase metodos
     */
    $objMetodos = new metodos();

    /**
     * Hacemos la consulta
     */
    $consultapass = "SELECT contrasenia
                    FROM usuario
                    WHERE nombre = '".$_POST["nombre"]."';";
    $objMetodos->realizarconsulta($consultapass);

    /**
     * Comprobamos si devuelve filas
     */
    if($objMetodos->comprobarnumrow()>0){
        /**
         * Extraemos las filas que hemos devuelto
         */
        $fila=$objMetodos->extraerfila();
        /**
         * guardamos en una variable hash la contraseña que obtenemos de la consulta anterior
         */
        $hash= $fila["contrasenia"];

        /**
         * Comprobamos mediante el metodo verify, si las credenciales coinciden con las de las bd
         */
        if($objMetodos->verificar($_POST["password"], $hash)){
            /**
             * Hacemos la consulta con la contraseña encriptada
             */
            $consulta =
                "
                    SELECT *
                    FROM usuario
                    WHERE nombre='" . $_POST["nombre"] . "' && contrasenia='" . $hash . "';
                ";
            $objMetodos->realizarconsulta($consulta);

            /**
             * Comprobamos si nos devuelve filas
             */
            if($objMetodos->comprobarnumrow()>0){
                $fila = $objMetodos->extraerfila();

                /**
                 * Sesiones creadas
                 */
                $_SESSION["nombre"] = $fila["nombre"];
                $_SESSION["tipo"] = $fila["tipo"];

                
                echo '<h3 class="true">El inicio de sesión se ha realizado correctamente</h3>';
                echo '<h3 class="true"><a href="index.php">Volver a inicio</a></h3>';

            }else{
                echo '<h3 class="false">Credenciales erroneas</h3>';
            }
            
        }else{
            echo '<h3 class="false">No es correcto</h3>';
            echo '<h3 class="true"><a href="login.php">Volver al login</a></h3>';
        }
    }else{
        echo '<h3 class="false">Creedenciales incorrectas, pruebe de nuevo</h3>';
        echo '<h3 class="true"><a href="login.php">Volver al login</a></h3>';
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