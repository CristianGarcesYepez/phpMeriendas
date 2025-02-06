<?php
    session_start();
    include_once '../bd/authModel.php';

    if (isset($_POST['usuario']) && isset($_POST['password'])) {
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];
        
        $auth = auth($usuario, $password);
        
        if($auth != null) {
            $_SESSION['usuario'] = $auth;
            $_SESSION['mensaje'] = "<div class='alert alert-success' role='alert'><strong>✨Bienvenido al sistema✨: $usuario</strong></div>";
            header('Location: ../dashboard.php');
            exit();
        } else {
            $_SESSION['mensaje'] = "<div class='alert alert-danger' role='alert'><strong>Usuario o contraseña incorrectos❌</strong></div>";
            header('Location: ../index.php');  // Cambiado a ruta relativa
            exit();
        }
    } else {
        $_SESSION['mensaje'] = "<div class='alert alert-danger' role='alert'><strong>Usuario o contraseña incorrectos❌</strong></div>";
        header('Location: ../index.php');  // Cambiado a ruta relativa
        exit();  // Agregado exit()
    }
