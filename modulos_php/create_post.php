<?php
session_start();
include 'conex.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare("INSERT INTO posts (user_id, title, content) VALUES (?, ?, ?)");
    $stmt->execute([$user_id, $title, $content]);
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Publicación</title>
</head>
<body>
    <h1>Crear Publicación</h1>
    <form method="POST">
        <input type="text" name="title" placeholder="Título" required>
        <textarea name="content" placeholder="Contenido" required></textarea>
        <button type="submit">Publicar</button>
    </form>
</body>
</html>