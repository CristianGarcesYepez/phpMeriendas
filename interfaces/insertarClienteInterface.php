<?php
    session_start(); // 0. Iniciar sesion

    if ($_POST['Nombre'] != null and $_POST['Correo'] != null and $_POST['Telefono'] != null and $_POST['Direccion'] != null) { // 1. Validar datos que llegan del formulario
        include_once '../bd/clienteModel.php'; // 2. Incluir el modelo de la tabla
        $nombre = $_POST['Nombre']; // 3. Recuperar datos del formulario
        $correo = $_POST['Correo']; // 3. Recuperar datos del formulario
        $telefono = $_POST['Telefono']; // 3. Recuperar datos del formulario
        $direccion = $_POST['Direccion'];

        $id = insertarCliente($nombre,$correo,$telefono,$direccion); // 4. Llamar a la funcion insertarCliente del modelo

        if ($id != null) { // 5. Validar si se inserto el registro
            
            $_SESSION['mensaje'] = "<div class='alert alert-success' role='alert'><strong>✅ Cliente insertado correctamente</strong></div>"; // 7. Mostrar mensaje de exito
        } else {
            $_SESSION['mensaje'] = "<div class='alert alert-danger' role='alert'><strong>❌ Error al insertar el registro</strong></div>"; // 7. Mostrar mensaje de error
        }

    } else {
        $_SESSION['mensaje'] = "<div class='alert alert-danger' role='alert'><strong>❌ Error al procesar el formulario</strong></div>"; // 8. Mostrar mensaje de error
    }
    header('Location: ../dashboard.php'); // 6. Redireccionar al dashboard