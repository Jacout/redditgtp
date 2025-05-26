<?php
session_start();
include 'modulos_php/conex.php';

if (!isset($_SESSION['user_id'])) {
    echo'<script type="text/javascript">
        alert("Favor de logearse");
        window.location.href="/redditgtp"
        </script>';
}

$user_id = $_SESSION['user_id'];
$stmt = $pdo->query("SELECT * FROM users WHERE id_user = '$user_id'");
$user = $stmt->fetch();

//cargar los post

$stmt2 = $pdo->query("SELECT title, content,created_at,username FROM posts
INNER JOIN users ON users.id_user=posts.user_id WHERE id_user = '$user_id'");

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Perfil</title>
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="redditgtp_icon/favicon-32x32.png">
</head>
<body>
    <!-- NAVBAR -->
    <div class="navbar">
        <a class="active" href="index.php"><i class="fa fa-fw fa-home"></i> Home</a>
        
        <?php

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

    <br><br><br><br><br>
    <!-- Seccion de perfil de usuario -->
    <!-- Sección de perfil de usuario mejorada -->
    <div class="profile-container">
        <div class="profile-card">
            <div class="profile-avatar">
                <img src="" alt="Avatar de usuario">
            </div>
            <div class="profile-info">
                <h2><?php echo htmlspecialchars($_SESSION['user']); ?></h2>
                <p class="profile-id">ID de Usuario: <?php echo htmlspecialchars($_SESSION['user_id']); ?></p>
                <p class="profile-bio">¡Bienvenido a tu perfil! Aquí puedes ver y editar tu información personal.</p>
                <a href="" class="profile-edit-btn"><i class="fa fa-pencil"></i> Editar Perfil</a>
                <a href="index.php" class="profile-home-btn"><i class="fa fa-home"></i> Volver a Inicio</a>
            </div>
        </div>
    </div>

    <!-- Apartados adicionales -->
    <div class="profile-sections">
        <div class="profile-section">
            <h3><i class="fa fa-user"></i> Sobre mí</h3>
            <p>
                <?php echo !empty($user['about']) ? htmlspecialchars($user['about']) : "Aún no has escrito nada sobre ti."; ?>
            </p>
        </div>
        <div class="profile-section">
            <h3><i class="fa fa-users"></i> Amigos</h3>
            <ul class="profile-list">
                <?php if (!empty($user['friends'])): ?>
                    <?php foreach ($user['friends'] as $friend): ?>
                        <li><i class="fa fa-user-circle"></i> <?php echo htmlspecialchars($friend); ?></li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li>No tienes amigos agregados aún.</li>
                <?php endif; ?>
            </ul>
        </div>
        <div class="profile-section">
            <h3><i class="fa fa-comments"></i>Post realizados</h3>
           <?php if ($stmt2 && $stmt2->rowCount() > 0){
            foreach ($stmt2->fetchAll() as $post){
            echo '<div class="publicacion">
                    <div class="votos">
                    <div class="arrow">&#9650;</div>
                    <div>0</div>
                    <div class="arrow">&#9660;</div>
                    </div>
                    <div class="contenido-publicacion">
                    <div class="titulo">',htmlspecialchars($post['title']), '</div>
                    <div class="meta">Publicado por', htmlspecialchars($post['username']), ' | ',
                    htmlspecialchars($post['created_at']), '</div>
                    <div class="contenido">', htmlspecialchars($post['content']) ,'</div>
                    </div></div>';
        }
    }
    else {
        echo "no hay publicaciones";
    }
    ?>

        </div>
    </div>

</body>
</html>