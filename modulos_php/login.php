<?php
session_start();
include 'conex.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_POST['uname'];
    $password = $_POST['psw'];



    //if ($user && password_verify($password, $user['password'])) {
    //validacion para evitar errores que no devuelva filas y enviar mensaje
    $result = $pdo -> query("SELECT * FROM users WHERE username = '$username'");
    if($result > 0)
    {
        $user = $result->fetch();
        echo $user;
        if ($user['password'] == $password){
            $_SESSION['user_id'] = $user['id'];
            header("Location: ../index.html");
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

