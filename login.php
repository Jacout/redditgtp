<?php
session_start();
include 'conex.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    //if ($user && password_verify($password, $user['password'])) {
    if ($user['password'] == $password){
        $_SESSION['user_id'] = $user['id'];
        header("Location: index.php");
        exit;
    } else {
        $error = "Usuario o contraseña incorrectos.";
    }
}
?>

