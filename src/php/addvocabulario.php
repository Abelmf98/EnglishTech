<?php
/**
     * @file addvocabulario.php
     * Archivo para añadir vocabulario.
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
     * Llamaos a los métodos
     */
    require_once 'metodos.php';

    /**
     * Instanciamos el objeto de la clase métodos
     */
    $objMetodo = new metodos();

    /**
     * Preparamos la consulta para devolver filas de la tabla categoria
     */
    $consulta = "SELECT * 
                FROM categoria";
    /**
     * Lanzamos la consulta
     */
    $objMetodo->realizarconsulta($consulta);


    /**
     * Comprobamos si hay filas
     */
    if($objMetodo->comprobarnumrow()>0){

        $prueba = $objMetodo->comprobarnumrow();
        
        /**
         * Formulario para añadir vocabulario
         */
        if(!isset($_POST["enviar"])){

            echo '
                <div class="flogin">
                    <form class="login" action="#" method="POST" enctype="multipart/form-data">
                        <label>Introduzca palabra en español</label>
                        <input type="text" name="palabraES"/>
                        <label>Introduzca palabra en ingles</label>
                        <input type="text" name="palabraEN"/>
                        <label>Introduzca imagen</label>
                        <input type="file" name="imagen"/>
                        <label>Seleccione la categoria a la que pertenece el vocabulario</label>
                        <select name="categoria">
                        ';
                        /**Mientras haya filas sacamos lo que tenemos en el array */
                        for($i=0;$i<$prueba;$i++){
        
                            $fila=$objMetodo->extraerfila();
        
                        echo'
                            <option value="'.$fila["idcategoria"].'">'.$fila["tipo"].'</option>
                        ';
                      
                        }
                        echo '
                        </select>
                        <input type="submit" name="enviar" value="Enviar"/>  
                    </form>
                </div>
                ';
        }else{
            /**
             * Nos aseguramos de que los campos están rellenos
             */
            if(empty($_POST['palabraES'])){
                echo '<h3>El campo palabras en español obligatorio</h3>';
            }else{
                $palabrasES = "'".$_POST['palabraES']."'";
            }

            if(empty($_POST['palabraEN'])){
                echo '<h3>El campo palabras en ingles de rellenar</h3>';
            }else{
                $palabrasEN = "'".$_POST['palabraEN']."'";
            }

            if(isset($_FILES['imagen'])) {

                if (isset($_FILES['imagen']['name']) && $_FILES['imagen']['name'] != "") {

                    //Datos necesarios del archivo
                    $imagen="'".basename($_FILES['imagen']['name'])."'";
                    $tipo = $_FILES['imagen']['type'];
                    $tamanio = $_FILES['imagen']['size'];
                    $temp = $_FILES['imagen']['tmp_name'];
   
                    //Comprobar tamaño y extensión del archivo
                   if (!((strpos($tipo, "png") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "gif")) && ($tamanio < 20000000))) {
   
                       //Si las características no son correctas mostrará este mensaje
                       echo    '<div>
                                   <p>Tamaño maximo: 2mb</p>
                                   <p>Extensiones: png - jpeg - jpg - gif</p>
                               </div>';
                   } 
               }
               /**
                * Creamos una variable para guardar la ruta de la imagen
                */
                $path = '../img/' . basename($_FILES['imagen']['name']);
                   
            }

            /**
             * Preparamos la consulta para hacer un insert en la tabla vocabulario
             */
            $consulta = "INSERT INTO vocabulario(palabrasES, palabrasEN, Imagen, idcategoria) 
            VALUES ($palabrasES, $palabrasEN, '".$path."', $_POST[categoria])";
            /**
             * Lanzamos la consulta
             */
            $objMetodo->realizarconsulta($consulta);

            /**
             * Comrobamos si se ha insertado correctamente
             */
            if($objMetodo->comprobar()>0){
                echo '<h3>Vocabulario añadido correctamente</h3>';
                echo '<a class="d" href="addvocabulario.php">Seguir creando vocabulario</a>';
            }else{
                echo '<h3>Error al añadir el vocabulario</h3>';
                echo '<a class="d" href="index.php">Volver a inicio</a>';
            }
            
        }
    }else{
        echo '<h3>Es necesario añadir categorias</h3>';
        echo '<a class="d" href="index.php">Volver a inicio</a>';
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