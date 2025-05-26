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

    <br><br><br><br>
    <!-- LOGIN MODAL o cerrar sesion -->
    
    <!-- Crear foro -->
    <h2>Crear nuevo foro</h2>
    <form action="modulos_php/crear_comunidad.php" method="POST">
        <input type="text" name="nombre" placeholder="Nombre de comunidad" required>
        <textarea name="descripcion" placeholder="Descripcion de la comunidad" required></textarea>
        <button type="submit">Crear</button>
        </form>;
    </div>
</body>
</html>