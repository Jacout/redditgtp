<?php

include 'conex.php';

$comunidades = $pdo->query("SELECT id_foro, nombre FROM comunidades LIMIT 3")->fetchAll();

echo '<ul>';
foreach ($comunidades as $comunidad){
    echo '<li>';
    echo '<a href="foro.php?comunidad=',htmlspecialchars($comunidad[0]),'">',htmlspecialchars($comunidad[1]),'</a>';
    echo '</li>';
}
echo '</ul>';
?>