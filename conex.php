<?php
$host = 'localhost';
$db = 'reddit_clone';
$user = 'root'; // Usuario por defecto de XAMPP
$pass = ''; // Contraseña por defecto de XAMPP

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>