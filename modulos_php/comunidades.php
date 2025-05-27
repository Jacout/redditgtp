<?php

include 'conex.php';

$comunidades = $pdo->query("CALL comunidades_carga")->fetchAll();

$lista = $comunidades;
echo '<ul>';
foreach ($comunidades as $comunidad){
    echo '<li>';
    echo '<a href="foro.php?comunidad=',htmlspecialchars($comunidad[0]),'">',htmlspecialchars($comunidad[1]),'</a>';
    echo '</li>';
}
echo '</ul>';
?>