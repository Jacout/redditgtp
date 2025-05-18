<?php
include 'conex.php';

$posts = $pdo->query("SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id = users.id ORDER BY created_at DESC LIMIT 10")->fetchAll();

foreach ($posts as $post):
            echo '<h2>' , htmlspecialchars($post["title"]) , '</h2>';
            echo '<p>' ,htmlspecialchars($post["content"]) , '</p>';
            echo '<p>Publicado por:', htmlspecialchars($post["username"]), '</p>' , '<hr>';
            endforeach;


?>