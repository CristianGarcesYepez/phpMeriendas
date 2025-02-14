<?php
    session_start();

    if (isset($_POST['id_pedido']) && $_POST['id_pedido'] != null) {
        include_once '../models/PedidoModel.php';
        $id_pedido = $_POST['id_pedido'];
        
        $pedidoModel = new PedidoModel();
        
        if ($pedidoModel->eliminar($id_pedido)) {
            $_SESSION['mensaje'] = "<div class='alert alert-success' role='alert'><strong>✅ Pedido #$id_pedido eliminado correctamente</strong></div>";
        } else {
            $_SESSION['mensaje'] = "<div class='alert alert-danger' role='alert'><strong>❌ Error al eliminar Pedido #$id_pedido</strong></div>";
        }
    } else {
        $_SESSION['mensaje'] = "<div class='alert alert-danger' role='alert'><strong>❌ Error al procesar el formulario</strong></div>";
    }
    header('Location: ../dashboardpedidos.php'); 