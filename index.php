<!DOCTYPE html>
<html lang="es">
<>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inicio</title>
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="redditgtp_icon/favicon-32x32.png">

</head>
<body>
    <!-- NAVBAR -->
    <div class="navbar">
        <a class="active" href="#"><i class="fa fa-fw fa-home"></i> Home</a>
        
        <?php
        session_start();

        if (!isset($_SESSION['user_id'])) {
            $_SESSION['user_id'] = 0;
        }
        if ($_SESSION['user_id'] == 0){

            echo '<a href="#" onclick="document.getElementById(\'id01\').style.display=\'block\'" style="width:auto;"><i class="fa fa-fw fa-user"></i> Login</a>';

        }
        else{
            echo'<a class="active" href="modulos_php/cerrar_sesion.php"><i class="fa fa-fw fa-home"></i>Cerrar Sesión</a>';
            echo'<a class="active" href="profile.php"><i class="fa-solid fa-user"></i>',htmlspecialchars($_SESSION['user']), '</a>';
        }
        ?>
        
        <!-- ajolote chan agrega para ver tu perfil un boton que tenga llamar al profile.php,otra cosa vas a agregar notificacion?, no lo hagas con el ogt-->
        <!-- Contenedor para el nombre de la página y la imagen -->
        <div class="navbar-right">
            <span class="page-name">RedditBlack</span>
            <br></br>
        </div>
    </div>

    <!-- LOGIN MODAL o cerrar sesion -->
    <div id="id01" class="modal">
    <form class="modal-content animate" action="modulos_php/login.php" method="post">
            <div class="container">
                <label for="uname"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="uname" required>
                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="psw" required>
                <button type="submit">Login</button>
                <label>
                    <input type="checkbox" checked="checked" name="remember"> Remember me
                </label>
            </div>
            <div class="container" style="background-color:#f1f1f1">
                <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
                <span class="psw">Forgot <a href="#">password?</a></span>
            </div>
        </form>
    </div>'
    <!-- Foro -->
    <div class="container">
        
        <br></br>
        
        <h2 style="text-align: left;">Comunidades recientes</h2>
        
        <?php
        include "modulos_php/comunidades.php";

        print_r($comunidades);

        if (!isset($_SESSION['user_id'])) {
            $_SESSION['user_id'] = 0;
        }
        if ($_SESSION['user_id'] != 0){
            echo'<a href="comunidad_new.php"><h3 style="text-align: left;">Crear comunidad</h3></a>';
            echo '<h2>Crear nuevo post</h2>
                <form action="modulos_php/create_post.php" method="POST">
                <input type="text" name="title" placeholder="Título" required>
                <textarea name="content" placeholder="Contenido" required></textarea>
            <select name="comunidad" id="comunidad">';
            foreach($comunidades as $comunidad){
            echo '<option value="', htmlspecialchars($comunidad[0]),'"><', htmlspecialchars($comunidad[1]),'</option>';
            }
            echo '</select>
            <br>
            <button type="submit">Crear</button>
                </form>';
        }
        else{
            echo '<h2> Post mas recientes</h2>';
            include "modulos_php\consulta_post.php";
        }

        ?>

        
    </div>
</body>
</html>