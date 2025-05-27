<?php
include 'conex.php';

$posts = $pdo->query("CALL ultimos_post")->fetchAll();

foreach ($posts as $post):
            echo '<h2>' , htmlspecialchars($post["title"]) , '</h2>';
            echo '<p>' ,htmlspecialchars($post["content"]) , '</p>';
            echo '<p>Publicado por:', htmlspecialchars($post["username"]), '</p>' , '<hr>';
            endforeach;


?>