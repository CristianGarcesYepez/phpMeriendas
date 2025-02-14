<?php
class PedidoModel {
    private $conn;
    
    public function __construct() {
        $this->conn = new PDO("mysql:host=localhost;dbname=db_meriendas", "root", "");
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function obtenerTodos() {
        $query = "SELECT p.id_pedido, p.cantidad_pedido, c.nombre, c.etapa, c.direccion, p.fecha_pedido, p.estado_pedido, p.total
                 FROM pedidos p 
                 JOIN clientes c ON p.id_cliente = c.id 
                 ORDER BY p.fecha_pedido DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($id) {
        $query = "SELECT p.*, c.nombre, c.etapa, c.direccion 
                 FROM pedidos p 
                 JOIN clientes c ON p.id_cliente = c.id 
                 WHERE p.id_pedido = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function filtrar($cliente_id = null, $fecha_inicio = null, $fecha_fin = null) {
        $where = [];
        $params = [];
        
        if ($cliente_id) {
            $where[] = "p.id_cliente = :id_cliente";
            $params[':cliente_id'] = $cliente_id;
        }
        
        if ($fecha_inicio) {
            $where[] = "p.fecha_pedido >= :fecha_inicio";
            $params[':fecha_inicio'] = $fecha_inicio;
        }
        
        if ($fecha_fin) {
            $where[] = "p.fecha_pedido <= :fecha_fin";
            $params[':fecha_fin'] = $fecha_fin;
        }
        
        $whereClause = count($where) > 0 ? "WHERE " . implode(" AND ", $where) : "";
        
        $query = "SELECT p.*, c.*
                 FROM pedidos p 
                 JOIN clientes c ON p.id_cliente = c.id 
                 $whereClause 
                 ORDER BY p.fecha_pedido DESC";
                 
        $stmt = $this->conn->prepare($query);
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crear($datos) {
        $query = "INSERT INTO pedidos (id_cliente, cantidad_pedido, total, estado_pedido, fecha_pedido) 
                 VALUES (:id_cliente, :cantidad_pedido, :total, :estado_pedido, :fecha_pedido)";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_cliente', $datos['id_cliente']);
        $stmt->bindParam(':fecha_pedido', $datos['fecha_pedido']);
        $stmt->bindParam(':cantidad_pedido', $datos['cantidad_pedido']);
        $stmt->bindParam(':estado_pedido', $datos['estado_pedido']);
        $stmt->bindParam(':total', $datos['total']);
        if ($stmt->execute()) {
            return $this->conn->lastInsertId();
        }
        return false;
    }

    public function actualizar($id, $datos) {
        $query = "UPDATE pedidos 
                 SET id_pedido = :id_pedido,
                    id_cliente = :id_cliente, 
                     cantidad_pedido = :cantidad_pedido, 
                     total = :total, 
                     estado_pedido = :estado_pedido,
                     fecha_pedido = :fecha_pedido
                 WHERE id_pedido = :id_pedido";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_pedido', $id);
        $stmt->bindParam(':id_cliente', $datos['id_cliente']);
        $stmt->bindParam(':cantidad_pedido', $datos['cantidad_pedido']);
        $stmt->bindParam(':total', $datos['total']);
        $stmt->bindParam(':estado_pedido', $datos['estado_pedido']);
        $stmt->bindParam(':fecha_pedido', $datos['fecha_pedido']);
        return $stmt->execute();
    }

    public function eliminar($id) {
        $query = "DELETE FROM pedidos WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
} 