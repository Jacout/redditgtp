<?php

include 'conex.php';

$comunidades = $pdo->query("SELECT nombre FROM comunidades LIMIT 3")->fetchAll();

echo '<ul>';
foreach ($comunidades as $comunidad):
    echo '<li>';
    echo '<a href="#">',htmlspecialchars($comunidad[0]),'</a>';

    echo '</li>';
    
endforeach;
echo '</ul>';
?>