<?php
session_start();
include 'conex.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_POST['uname'];
    $password = $_POST['psw'];


    try{
    //if ($user && password_verify($password, $user['password'])) {
    //validacion para evitar errores que no devuelva filas y enviar mensaje
    $result = $pdo -> prepare("CALL proceso_login(?)");
    $result->execute([$username]);
    $f_numero = $result->rowCount();
    if($f_numero > 0)
    {
        $user = $result->fetch();
        if ($user['password'] == $password){
            $_SESSION['user_id'] = $user['id_user'];
            $_SESSION['user'] = $user['username'];
            echo'<script type="text/javascript">
            alert("Bienvenido ' , htmlspecialchars($username), '");
            window.location.href="/redditgtp"
            </script>';
            exit;
        }
        else {
            echo'<script type="text/javascript">
        alert("Usuario incorrecto, intente de nuevo");
        window.location.href="/redditgtp"
        </script>';
        
    }
}
else{
    echo'<script type="text/javascript">
        alert("Usuario no registrado, intente de nuevo");
        window.location.href="/redditgtp"
        </script>';
}
}
catch(Exception $e){
    $archivo = "logs.txt";
    file_put_contents($archivo,$e);
}
}
?>

