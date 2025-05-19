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
$stmt = $pdo->query("SELECT * FROM users WHERE id = '$user_id'");
$user = $stmt->fetch();
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
                <p class="profile-id">ID de Usuario: <?php echo htmlspecialchars($user['id']); ?></p>
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
            <h3><i class="fa fa-comments"></i> Comunidades</h3>
            <ul class="profile-list">
                <?php if (!empty($user['communities'])): ?>
                    <?php foreach ($user['communities'] as $community): ?>
                        <li><i class="fa fa-hashtag"></i> <?php echo htmlspecialchars($community); ?></li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li>No sigues ninguna comunidad todavía.</li>
                <?php endif; ?>
            </ul>
        </div>
    </div>

</body>
</html>