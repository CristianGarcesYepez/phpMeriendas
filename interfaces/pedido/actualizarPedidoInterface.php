<?php
    session_start();

    if ($_POST['id_pedido'] != null && $_POST['id_cliente'] != null && $_POST['fecha_pedido'] != null && 
        $_POST['cantidad_pedido'] != null && $_POST['estado_pedido'] != null) {
        include_once '../../models/pedidoModel.php';
        $id_pedido = $_POST['id_pedido'];
        $id_cliente = $_POST['id_cliente'];
        $cantidad_pedido = $_POST['cantidad_pedido'];
        $total = $_POST['total'];   
        $estado_pedido = $_POST['estado_pedido'];
        $fecha_pedido = $_POST['fecha_pedido'];

        $pedidoModel = new PedidoModel();
        $datos = [
            'id_pedido' => $id_pedido,
            'id_cliente' => $id_cliente,
            'cantidad_pedido' => $cantidad_pedido,
            'total' => $total,
            'estado_pedido' => $estado_pedido,
            'fecha_pedido' => $fecha_pedido
        ];

        if ($pedidoModel->actualizar($id_pedido, $datos)) {
            $_SESSION['mensaje'] = "<div class='alert alert-success' role='alert'><strong>✅ Pedido actualizado correctamente</strong></div>";
            header('Location: ../../dashboardpedidos.php');
        } else {
            $_SESSION['mensaje'] = "<div class='alert alert-danger' role='alert'><strong>❌ Error al actualizar el pedido</strong></div>";
            header('Location: ../../views/pedidos/editarPedido.php?id='.$id_pedido);
        }
    } else {
        $_SESSION['mensaje'] = "<div class='alert alert-danger' role='alert'><strong>❌ Error al procesar el formulario</strong></div>";
    }
    header('Location: ../../dashboardpedidos.php'); 