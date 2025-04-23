<?php
session_start();
include 'conex.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['username'];
    $password = $_POST['password'];


    $stmt = $pdo->prepare("INSERT INTO users (username,password) VALUES (?, ?)");
    $stmt->execute([$user,$password]);
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
</head>
<body>
    <h1>Iniciar Sesión</h1>
    <form method="POST">
        <input type="text" name="username" placeholder ="Usuario" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <button type="submit">Registrarse</button>
    </form>
    <?php if (isset($error)): ?>
        <p><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
</body>
</html>