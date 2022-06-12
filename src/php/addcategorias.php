<?php
/**
     * @file addcategorias.php
     * Archivo para añadir categorías.
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
         * Necesitaremos el archivo de metodos mysqli
         */
            require_once 'metodos.php';

        /**
         * Instanciamos la clase metodos
         */
            $objMetodo = new metodos();

            /**
             * Formulario para elegir categoria
             */

            if(!isset($_POST["enviar"])){
                echo '
                    <form class="login" action="#" method="POST">
                        <label>Introduzco el tipo de categoria</label>
                        <input type="text" name="tipo"/><br>
                        <input type="submit" name="enviar" value="Enviar"/> 
                    </form>
                ';
            }else{
                /**
                 * Comprobamos si se han rellenado los campos
                 */
                if(empty($_POST["tipo"])){
                    echo "No has introducido ningun tipo de categoria";
                }else{
                    /**
                     * Guardamos el tipo de categoria en una variable
                     */
                    $tipo = "'".$_POST["tipo"]."'";


                    /**
                     * Preparamos la consulta para añadir tipos a categoria
                     */
                    $consulta = "INSERT INTO categoria(tipo)
                    VALUES  ($tipo)";

                    /**
                     * Realizamos la consulta
                     */
                    $objMetodo->realizarconsulta($consulta);

                    /**
                     * Comprobamos si se ha añadido correctamente, y han cambiando las filas afectadas
                     */
                    if($objMetodo->comprobar()>0){
                        echo '<h3>Se ha añadido la categoria correctamente</h3>';
                        echo '<a class="d" href="preparar.php">Crear ejercicio</a>';
                    }else{
                        echo '<h3>Se ha producido un error al añadir la categoria</h3>';
                        echo '<a class="d" href="index.html">Volver a inicio</a>';
                    }
                }
                
            }
        ?>
    </main>
    <footer class="pie">
        <h5><a>Contáctanos - 924 00 22 77</a></h5>
        <h5><a>Aviso Legal</a></h5>
        <h5><a>Política de Privacidad</a></h5>
    </footer>
</body>
</html>