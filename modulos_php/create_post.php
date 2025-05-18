<?php
session_start();
include 'conex.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'];

    $stmt = $pdo->query("INSERT INTO posts (user_id, title, content) VALUES ('$user_id','$title' , '$content')");
    //$stmt = $pdo->prepare("INSERT INTO posts (user_id, title, content) VALUES (?, ?, ?)");
    //$stmt->execute([$user_id, $title, $content]);
    echo'<script type="text/javascript">
        alert("Post creado con exito");
        window.location.href="/redditgtp"
        </script>';
    exit;
}
?>