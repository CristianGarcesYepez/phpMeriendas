<?php
    session_start();
    $_SESSION['mensajeLogout'] = "<div class='alert alert-success' role='alert'><strong>✅Sesión cerrada correctamente</strong></div>";
    header('Location: ../index.php');
    exit();


