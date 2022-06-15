<?php
/**
     * @file registro.php
     * Archivo de registro con el cual guaradermos la contraseña encriptada.
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
        session_start();
        require_once 'metodos.php';
        $objMetodos =new metodos();
        
        /**
         * Formulario de registro
         */
        if(!isset($_POST["enviar"])){
            echo
            '
                <form class="login" action="" METHOD="POST">
                <label for ="nombre">Introduce el nombre de usuario</label></br>
                <input type="text" name="nombre" placeholder="Introduce el usuario" required />
                <label for ="apellido">Introduce el apellido de usuario</label></br>
                <input type="text" name="apellido" placeholder="Introduce el apellido" required />
                <label for ="password">Introduce la contraseña</label></br>
                <input type="password" name="password" placeholder="Contraseña" required/>
                <label for ="password2">Repite tu contraseña</label></br>
                <input type="password" name="password2" placeholder="Contraseña" required/>
                <input type="submit" value="Enviar" name="enviar"/>
                </form>
                ';
                }
        else
        {
            /**
             * Comprobamos que los campos no estén vacios
             */
            if($_POST["password"]== $_POST["password2"] and
                (!empty($_POST["nombre"] and $_POST["apellido"] and $_POST["password"] and $_POST["password2"])))
            {
                /**
                 * varaible que con el que recogemos el metodo de encriptacion
                 */
                $encriptar=$objMetodos->encriptar($_POST["password"]);

                /**
                 * Hacemos la consulta, donde tambien le pasaremos la contraseña recogida
                 */
               $consulta = "INSERT INTO usuario(nombre, apellidos, contrasenia, tipo)
                            VALUES('".$_POST["nombre"]."', '".$_POST["apellido"]."', '$encriptar', 'u')
               
               ";
               $objMetodos->realizarconsulta($consulta);

               /**
                * Comprobamos que hay filas afectas para ver si se ha añadido correctamente
                */
                if($objMetodos->comprobar()>0)
                {
                    echo '<h3>El usuario fue añadido correctamente</h3>';
                }
                else
                {
                    echo '<h3>usuario no fue añadido</h3>';
                }
            }
            else
            {
                echo 'Por favor rellene todos los campos';
            }

        }

        ?>
    </main>
    <footer>
        <h5><a>Contáctanos - 924 00 22 77</a></h5>
        <h5><a>Aviso Legal</a></h5>
        <h5><a>Política de Privacidad</a></h5>
    </footer>
</body>
</html>