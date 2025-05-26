<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include("conex.php");
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $user_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare("INSERT INTO comunidades (nombre,descripcion,administrador) VALUES
    (?,?,?)");
    $stmt->execute([$nombre,$descripcion,$user_id]);
    if ($stmt == true){
        echo'<script type="text/javascript">
        alert("Comunidad creada con exito");
        window.location.href="/redditgtp"
        </script>';
    exit;
    }
    else{
        echo'<script type="text/javascript">
        alert("Ocurrio un error");
        window.location.href="/redditgtp"
        </script>';
    }
}

?>