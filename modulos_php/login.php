<?php
session_start();
include 'conex.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_POST['uname'];
    $password = $_POST['psw'];



    //if ($user && password_verify($password, $user['password'])) {
    //validacion para evitar errores que no devuelva filas y enviar mensaje
    $result = $pdo -> query("SELECT * FROM users WHERE username = '$username'");
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
?>

