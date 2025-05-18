<?php

    session_start(); // Inicia la sesión
    session_unset(); // Borra las variables de sesión
    session_destroy(); // Destruye la sesión
    echo'<script type="text/javascript">
        alert("Sesion cerrada, redirigiendo al inicio");
        window.location.href="/redditgtp"
        </script>';
    exit();



?>