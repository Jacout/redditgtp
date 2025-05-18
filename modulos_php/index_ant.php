<?php
session_start();
include 'conex.php';

$posts = $pdo->query("SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id = users.id ORDER BY created_at DESC")->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio</title>
</head>
<body>
    <h1>Publicaciones</h1>
    <a href="create_post.php">Crear Publicación</a>
    <button class="button button5" href="create_post.php">+</button>
    <a href="login.php">Iniciar Sesión</a>
    <a href="registro.php">Registro</a>
    <a href="profile.php">Perfil</a>
    <a href="cerrar_sesion.php"></a>


    <?php foreach ($posts as $post): ?>
        <h2><?php echo htmlspecialchars($post['title']); ?></h2>
        <p><?php echo htmlspecialchars($post['content']); ?></p>
        <p>Publicado por: <?php echo htmlspecialchars($post['username']); ?></p>
        <hr>
    <?php endforeach; ?>
</body>
</html>