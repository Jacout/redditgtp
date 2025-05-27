<?php
include("modulos_php/conex.php");
$comunidad = $_GET['comunidad'];
// Consulta para obtener las publicaciones
$sql = "CALL post_foro(?)";
$resultado = $pdo->prepare($sql);
$resultado->execute($comunidad);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Foro - Publicaciones</title>
    <link rel="stylesheet" href="styles/style_foro.css">
</head>
<body>
    <div class="navbar">
        <a class="active" href="index.php"><i class="fa fa-fw fa-home"></i> Home</a>
        
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
<br><br><br><br>
    <div class="header">RedditGTP - Foro</div>
    <div class="container">
        <?php 
        if ($resultado && $resultado->rowCount() > 0){
        foreach ($resultado as $post){
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
</body>
</html>