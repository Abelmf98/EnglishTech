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
    /**Método para el inicio de sesión */
    session_start();
    require_once 'metodos.php';

    /**
     * Comprobamos si no hay sesión iniciada para mostrar un estracto de la página
     */
    if(!isset($_SESSION["tipo"])){
    echo '
    <header>
        <a href="#" class="logo">
            <img src="../img/logo.png" alt="logo">
            <h2 class="nombre">EnglishTech</h2>
        </a>
        <nav>
            <a href="login.php" class="nav">Login</a>
        </nav>
    </header>
    <main>
        <div>
            <h1>¡Bienvenid@s a EnglishTech!</h1>
        </div>
    </main>
';
}else{
    /**
     * Si hay sesión tipo usuario, le mostrarmos una interfaz ideada para el usuario
     */
    if($_SESSION["tipo"]=='u'){
        echo '
            <header>
                <a href="#" class="logo">
                    <img src="../img/logo.png" alt="logo">
                    <h2 class="nombre">EnglishTech</h2>
                </a>
                <nav>
                    <a href="cerrarSesion.php" class="nav">Cerrar sesión</a>
                </nav>
            </header>
            <main>
                <div>
                    <h1>¡Bienvenid@s a EnglishTech!</h1>
                    <button><a href="categorias.html">Empieza a practicar</a></button>
                </div>
            </main>
            ';
        }
        /**
         * Si hay sesión tipo administrador, le mostrarmos una interfaz ideada para el administrador
         */
        if($_SESSION["tipo"]=='a'){
        echo '
            <header>
                <a href="#" class="logo">
                    <img src="../img/logo.png" alt="logo">
                    <h2 class="nombre">EnglishTech</h2>
                </a>
                <nav>
                    <a href="cerrarSesion.php" class="nav">Cerrar sesión</a>
                    <a href="registro.php" class="nav">Registro</a>
                    <a href="addcategorias.php" class="nav">1-Alta de categorias</a>
                    <a href="addvocabulario.php" class="nav">2-Alta de vocabulario</a>
                    <a href="preparar.php" class="nav">3-Preparar ejercicio</a>
                </nav>
            </header>
            <main>
                <div>
                    <h1>¡Bienvenid@s a EnglishTech!</h1>
                    <button><a href="categorias.html">Empieza a practicar</a></button>
                </div>
            </main> ';
        }
}
?>
    <footer>
        <h5><a>Contáctanos - 924 00 22 77</a></h5>
        <h5><a>Aviso Legal</a></h5>
        <h5><a>Política de Privacidad</a></h5>
    </footer>
</body>
</html>