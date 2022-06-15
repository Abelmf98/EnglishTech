<?php
/**
     * @file ejercicio.php
     * Archivo para hacer el ejercicio.
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
    <main class="menu-juego-php">
        <?php
        session_start();

            require_once 'metodos.php';

            $objMetodo = new metodos();

            /**
             * Preparamos la consulta con la cual sacaremos valores unicos combinando tablas
             */
            $consulta = ' SELECT DISTINCT(e.idejercicio), e.descripcion
                FROM vocabulario_ejercicio ve
                INNER JOIN ejercicio e
                ON ve.idejercicio = e.idejercicio
                INNER JOIN vocabulario v
                ON v.idvocabulario = ve.idvocabulario
                WHERE idcategoria = '.$_GET["t"].'
            ';
            /**
             * Lanzamos la consulta
             */
            $objMetodo->realizarconsulta($consulta);

            /**
             * Formulario para seleccionar el ejercicio que desea hacer de los guardados
             */
            if(!isset($_POST["enviar"]) && (!isset($_POST["enviar2"]))){

            echo '
                <form class="login" action="#" method="POST">
                    <label>Seleccione el ejercicio que desea realizar</label>
                    <select name="ejercicio">
                    ';
                    while($fila=$objMetodo->extraerfila()){

                        echo '
                            <option value="'.$fila["idejercicio"].'">'.$fila["descripcion"].'</option>
                        ';
                    }
                    echo '
                    </select>
                    <input type="submit" name="enviar" value="Enviar"/>
                </form> 
            ';
        }else{

            if(isset($_POST["enviar"]) && (!isset($_POST["enviar2"]))){
                /**
                 * Preparamos la consulta con la cual necesitaremos combinar tablas
                 */
                $consulta = ' SELECT v.idvocabulario, v.palabrasES, v.palabrasEN, v.Imagen
                            FROM vocabulario_ejercicio ve
                            INNER JOIN vocabulario v
                            ON v.idvocabulario = ve.idvocabulario
                            WHERE idejercicio = '.$_POST["ejercicio"].';
                ';
                /**
                 * Lanzamos la consulta
                 */
                $objMetodo->realizarconsulta($consulta);
                $fila = $objMetodo->extraerfila();
                /**
                 * Formulario del ejercicio a hacer
                 */
                echo '<form action="#" method="post">
                <div class="juego">
                    <img src="'.$fila["Imagen"].'" alt="'.$fila["palabrasES"].'">
                    <h3>'.$fila["palabrasES"].'</h3>
                        <label>Introduzca el nombre en ingles de la imagen: </label>
                        <input type="text" placeholder="Introduce lo que ves en la imagen" name="palabrasEN">
                        <input type="hidden" name="palabrasES" value="'.$fila["palabrasES"].'">
                        </div>
                    <input type="submit" name="enviar2" value="Enviar Respuesta">
                </form>
            ';
            }else{
                /**
                 * Comprobación de la respuesta
                 */
                if(!empty($_POST["palabrasEN"])){
                    $consulta = "SELECT *
                                FROM vocabulario
                                WHERE palabrasEN = '".$_POST["palabrasEN"]."' AND palabrasES = '".$_POST["palabrasES"]."';";
                   $objMetodo->realizarconsulta($consulta);

                   if($objMetodo->comprobarnumrow()>0){
                    echo '<h3 class="true"><a class="true"href="categorias.html">La respuestas es correcta</a></h3>'.'<br>';
                   }else{
                    echo '<h3><span><a href="index.php">Respuesta incorrecta, intentalo de nuevo</a></span></h3>'.'<br>';
                   }
                }else{
                    echo 'Se deben rellenar todos los campos';
                }
            }
        }
        ?>
    </main>     
    <footer class="pie-juego">
            <h5><a>Contáctanos - 924 00 22 77</a></h5>
            <h5><a>Aviso Legal</a></h5>
            <h5><a>Política de Privacidad</a></h5>
    </footer>
    </body>
</html>