<?php
    session_start();

    if ($_POST['id_cliente'] && $_POST['fecha_pedido'] != null && $_POST['cantidad_pedido'] != null && $_POST['total'] != null && $_POST['estado_pedido']) {
        include_once '../../models/pedidoModel.php';
        $id_cliente = $_POST['id_cliente'];
        $fecha_pedido = $_POST['fecha_pedido'];
        $cantidad_pedido = $_POST['cantidad_pedido'];
        $total = $_POST['total'];
        $estado_pedido = $_POST['estado_pedido'];

        $pedidoModel = new PedidoModel();
        $datos = [
            'id_cliente' => $id_cliente,
            'fecha_pedido' => $fecha_pedido,
            'cantidad_pedido' => $cantidad_pedido,
            'total' => $total,
            'estado_pedido' => $estado_pedido
        ];

        if ($pedidoModel->crear($datos)) {
            $_SESSION['mensaje'] = "<div class='alert alert-success' role='alert'><strong>✅ Pedido insertado correctamente</strong></div>";
        } else {
            $_SESSION['mensaje'] = "<div class='alert alert-danger' role='alert'><strong>❌ Error al insertar el pedido</strong></div>";
        }
    } else {
        $_SESSION['mensaje'] = "<div class='alert alert-danger' role='alert'><strong>❌ Error al procesar el formulario</strong></div>";
    }
    header('Location: ../../dashboardpedidos.php'); 