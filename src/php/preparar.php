<?php
/**
     * @file preparar.php
     * Archivo para crear el ejercicio.
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
         * Instanciamos el objeto de la clase metodos
         */
        $objMetodo = new metodos();

        /**
         * Preparamos la consulta para devolver filas de la tabla vocabulario
         */
        $consulta= "SELECT *
                    FROM vocabulario";
        /**
         * Lanzamos la consulta
         */
        $objMetodo->realizarconsulta($consulta);

        /**
         * Comprobamos si hay filas
         */
        if($objMetodo->comprobarnumrow()>0){

            $consulta = "SELECT *
                        FROM categoria";
            $objMetodo->realizarconsulta($consulta);

            
            
            if($objMetodo->comprobarnumrow()>0){

                /**
                 * Formulario para seleccionar el ejercicio
                 */
                if(!isset($_POST["enviar"]) && (!isset($_POST["enviar2"]))){
                echo '
                <div class="flogin">
                    <form class="login" action="#" method="POST">
                        <label>Selecciona la categoria sobre la que quieres hacer el ejercicio</label>
                        <select name="categoria">
                        ';
                        /**
                         * Extraemos la informacion del array para mostrarlas en el option
                         */
                        while($fila=$objMetodo->extraerfila()){
                           echo '<option value="'.$fila["idcategoria"].'">'.$fila["tipo"].'</option>';
                        }
                        echo '
                        </select>

                        <input type="submit" name="enviar" value="Enviar"/>
                    </form>
                </div>
                ';
                }else{
                    /**
                     * Formulario para preparar el ejercicio a realizar
                     */
                    if(isset($_POST["enviar"]) && (!isset($_POST["enviar2"]))){
                        /**
                         * Guardamos la fecha con una variable, que estará en oculto pero se reflejara en la base de datos
                         */
                        $fechaaactual = date("Y-m-d H:i:s");
                        echo '
                            <form class="login"action="#" method="POST">
                                <label>Escriba una descipción del ejercicio</label>
                                <input type="text" name="descripcion"/>
                                <input type="hidden" value="'.$fechaaactual.'" name="hora" readonly> 
                                <label>Seleccione el tipo de vocabulario que quiere añadir</label>
                                ';
                                /**
                                 * Seleccionamos las palabras que queremos que aparezcan hasta 5
                                 */
                                for($i=0;$i<5;$i++){
                                    $consulta = "SELECT *
                                    FROM vocabulario
                                    WHERE idcategoria = ".$_POST["categoria"];
                                    $objMetodo->realizarconsulta($consulta);
                                    echo '<select name="vocabulario'.$i.'">
                                    ';
                                    for($j=0;$j<$fila=$objMetodo->extraerfila(); $j++){
                                    echo '
                                        <option value="'.$fila["idvocabulario"].'">'.$fila["palabrasES"].'</option>
                                    ';
                                } 
                                    echo '                                    
                                    </select>';
                                }
                                echo '
                                <input type="submit" name="enviar2" value="Enviar"/>
                            </form>
                        ';
                    }else{

                        /**
                         * Comprobamos errores
                         */
                        if(empty($_POST["descripcion"])){
                            echo '<h3>No has escrito ninguna descripción</h3>';
                            echo '<a class="d" href="preparar.php">Volver a crear ejercicio</a>';
                        }else{
                            
                            /**
                             * Preparamos consulta para insertar datos en el tabla ejercicio
                             */
                            $consulta = " INSERT INTO ejercicio(descripcion, fechahora)
                                            VALUES ('".$_POST["descripcion"]."','".$_POST["hora"]."');";
                            $objMetodo->realizarconsulta($consulta);

                            if($objMetodo->comprobar()<0){
                                echo '<h3>Se ha producido un error</h3>';
                                echo '<a href="preparar.php">Volver a crear ejercicio</a>';
                            }else{
                                /**
                                 * Guardamos el id en una variable, ya que sirve de identificativo
                                 */
                                $id = $objMetodo->extraerID();

                                for($i=0;$i<5;$i++){

                                /**
                                 * Preparamos la consulta
                                 */
                                $consulta = ' INSERT INTO vocabulario_ejercicio (idvocabulario, idejercicio)
                                            VALUES ('.$_POST["vocabulario$i"].', '.$id.');';
                                $objMetodo->realizarconsulta($consulta);
                                
                                }
                                /**
                                 * Comrobamos si se ha insertado correctamente
                                 */
                                if($objMetodo->comprobar()>0){
                                    echo '<h3>Se ha añadido correctamente</h3>';
                                    echo '<a class="d" href="index.html">Volver a inicio</a>';
                                }else{

                                    echo '<h3>Se ha producido un error</h3>';
                                    echo '<a href="preparar.php">Volver a crear ejercicio</a>';
                                }
                            }
                        } 
                            
                    }
                }
            }else{
                echo '<h3>Es necesario crear una categoria</h3>';
                echo '<a class ="d" href="addcategoria.php">Crear categoria</a>';
            }
            
        }else{
            echo 'No existe vocabulario'.'<br>';
            echo '<a class="d" href="addvocabulario.php">Añadir Vocabulario</a>';

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