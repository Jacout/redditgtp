<?php
session_start();
include 'conex.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['uname'];
    $password = $_POST['psw'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    //if ($user && password_verify($password, $user['password'])) {
    if ($user['password'] == $password){
        $_SESSION['user_id'] = $user['id'];
        header("Location: ../index.html");
        exit;
    } else {
        echo'<script type="text/javascript">
        alert("Usuario no registrado, intente de nuevo");
        </script>
        window.location.href="localhost/redditgtp"';
        
    }
}
?>

