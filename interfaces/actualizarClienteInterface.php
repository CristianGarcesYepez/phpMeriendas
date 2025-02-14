<?php
    session_start(); // 0. Iniciar sesion

    if ($_POST['ID'] != null and $_POST['Nombre'] != null and $_POST['Telefono'] != null and $_POST['Etapa'] != null and $_POST['Direccion'] != null) { // 1. Validar datos que llegan del formulario
        include_once '../bd/clienteModel.php'; // 2. Incluir el modelo de la tabla
        $id = $_POST['ID']; // 3. Recuperar datos del formulario
        $nombre = $_POST['Nombre']; // 3. Recuperar datos del formulario
        $telefono = $_POST['Telefono']; // 3. Recuperar datos del formulario
        $etapa = $_POST['Etapa']; // 3. Recuperar datos del formulario
        $direccion = $_POST['Direccion'];

        $nroFilas = actualizarCliente($id,$nombre,$telefono,$etapa,$direccion); // 4. Llamar a la funcion actualizarCliente del modelo

        if ($nroFilas >= 1) { // 5. Validar si se inserto el registro
            
            $_SESSION['mensaje'] = "<div class='alert alert-success' role='alert'><strong>✅ Cliente: $nombre actualizado correctamente</strong></div>"; // 7. Mostrar mensaje de exito
            header('Location: ../dashboard.php'); // Redireccionar al dashboard
        } else {
            $_SESSION['mensaje'] = "<div class='alert alert-danger' role='alert'><strong>❌ Error al actualizar Cliente $nombre</strong></div>"; // 7. Mostrar mensaje de error
            header('Location: ../editar.php?id='.$id); // Redireccionar a editar
        }

    } else {
        $_SESSION['mensaje'] = "<div class='alert alert-danger' role='alert'><strong>❌ Error al procesar el formulario</strong></div>"; // 8. Mostrar mensaje de error
    }
    header('Location: ../dashboard.php'); // 6. Redireccionar al dashboard
