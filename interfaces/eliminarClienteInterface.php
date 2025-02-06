<?php
    session_start(); // 0. Iniciar sesion

    if (isset($_POST['id']) && $_POST['id'] != null) { // 1. Validar datos que llegan del formulario
        include_once'../bd/clienteModel.php'; // 2. Incluir el modelo de la tabla
        $id = $_POST['id']; // 3. Recuperar datos del formulario
        
        $nroFilas = eliminarCliente($id); // 4. Llamar a la funcion insertarActividad del modelo
        
        if ($nroFilas >= 1) { // 5. Validar si se eliminó el registro
            
            $_SESSION['mensaje'] = "<div class='alert alert-success' role='alert'><strong>✅ Cliente '$id' eliminado correctamente</strong></div>"; // 7. Mostrar mensaje de exito
            
        } else {
            $_SESSION['mensaje'] = "<div class='alert alert-danger' role='alert'><strong>❌ Error al eliminar Cliente '$id'</strong></div>"; // 7. Mostrar mensaje de error

        }

    } else {
        $_SESSION['mensaje'] = "<div class='alert alert-danger' role='alert'><strong>❌ Error al procesar el formulario</strong></div>"; // 8. Mostrar mensaje de error
    }
    header('Location: ../dashboard.php'); // 6. Redireccionar al dashboard