
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
        <?php
        echo '
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
        <main class="menu-juego-php">
        ';
        require_once 'metodos.php';
        $objMetodo = new metodos();

        $consulta = 'SELECT * 
                        FROM vocabulario
                        WHERE idcategoria = '.$_GET["t"].';';
        $objMetodo->realizarconsulta($consulta);
       /*  $numero = $objMetodo->comprobarnumrow();
        echo $numero; */

        if($objMetodo->comprobarnumrow()<0){
            echo 'Se ha producido un error';
        }else{
            if($objMetodo->comprobarnumrow()== 0){
                echo 'No hay datos';
            }else{

                /* for($i = 0;$i<$numero; $i++){
                    $a = array(
                        "$i" => $fila["idvocabulario"],
                    );
                }
                print_r($a);  */ 
                    
                /* 
                $colores = array("1", "2", "3", "4", "5", "6");
                echo "Array original";
                var_export ($colores);
                echo "Valor aleatorio: ". $colores[array_rand($colores)]; */

                $consulta2 = 'SELECT * 
                        FROM vocabulario
                        WHERE idcategoria = '.$_GET["t"].' ;';
                $objMetodo->realizarconsulta($consulta2);

                if(!isset($_POST["Enviar"])){
                $fila = $objMetodo->extraerfila();
                
                echo '<form action="#" method="post">
                <div class="juego">
                    <img src="../img/'.$fila["Imagen"].'" alt="Animal">
                    <h3>'.$fila["palabrasES"].'</h3>
                        <label>Introduzca el nombre en ingles de la imagen: </label>
                        <input type="text" placeholder="Introduce lo que ves en la imagen" name="palabrasEN">
                        <input type="hidden" name="palabrasES" value="'.$fila["palabrasES"].'">
                        </div>
                
                    <input type="submit" name="Enviar" value="Enviar Respuesta">
                </form>
            ';

            }else{
               if(!empty($_POST["palabrasEN"])){
                    $consulta = "SELECT *
                                FROM vocabulario
                                WHERE palabrasEN = '".$_POST["palabrasEN"]."' AND palabrasES = '".$_POST["palabrasES"]."';";
                    $objMetodo->realizarconsulta($consulta);
                    if($objMetodo->comprobarnumrow()>0){
                        echo '<h3 class="true">La respuestas es correcta</h3>';
                    }else{
                        echo '<h3><span>Respuesta incorrecta, intentalo de nuevo<span></h3>';
                    }
               }else{
                   echo 'Se deben rellenar todos los campos';
               }
            }
            echo '
            </main>
        ';
            }
        }
        echo '
        <footer class="pie-juego">
            <h5><a>Contáctanos - 924 00 22 77</a></h5>
            <h5><a>Aviso Legal</a></h5>
            <h5><a>Política de Privacidad</a></h5>
        </footer>
        ';
        ?>
    </body>
</html>