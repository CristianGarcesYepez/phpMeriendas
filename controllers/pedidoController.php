<?php
require_once '../models/pedidoModel.php';

class PedidoController {
    private $model;
    
    public function __construct() {
        $this->model = new PedidoModel();
    }
    
    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $datos = [
                'id_cliente' => $_POST['id_cliente'],
                'fecha_pedido' => $_POST['fecha_pedido'],
                'cantidad_pedido' => $_POST['cantidad_pedido'],
                'estado_pedido' => $_POST['estado_pedido']
            ];
            
            try {
                if ($this->model->crear($datos)) {
                    $_SESSION['mensaje'] = "Pedido creado exitosamente";
                    $_SESSION['tipo_mensaje'] = "success";
                } else {
                    $_SESSION['mensaje'] = "Error al crear el pedido";
                    $_SESSION['tipo_mensaje'] = "danger";
                }
            } catch (Exception $e) {
                $_SESSION['mensaje'] = "Error: " . $e->getMessage();
                $_SESSION['tipo_mensaje'] = "danger";
            }
            
            header('Location: ../dashboardpedidos.php');
            exit;
        }
    }
    
    public function procesar() {
        if (!isset($_POST['action'])) {
            header('Location: ../dashboardpedidos.php');
            exit;
        }

        switch ($_POST['action']) {
            case 'crear':
                $this->crear();
                break;
            default:
                header('Location: ../dashboardpedidos.php');
                break;
        }
    }
}

// Iniciar el controlador
$controller = new PedidoController();
$controller->procesar(); 