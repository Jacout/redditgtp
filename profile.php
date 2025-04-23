<?php
session_start();
include 'conex.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perfil</title>
</head>
<body>
    <h1>Perfil de <?php echo htmlspecialchars($user['username']); ?></h1>
    <p>ID de Usuario: <?php echo htmlspecialchars($user['id']); ?></p>
    <a href="index.php">Volver a Inicio</a>
</body>
</html>