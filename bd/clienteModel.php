<?php
    include_once 'conexion.php';
    
    function insertarCliente($nombre,$correo,$telefono,$direccion){

        try{
            $conn = conectar();// 1. Conectamos a la base de datos

            $sql = "INSERT INTO clientes (nombre, correo, telefono, direccion) 
                VALUES (:nombre, :correo, :telefono, :direccion)"; // 2. Definimos la consulta SQL

            $stmt = $conn->prepare($sql); // 3. Preparamos la consulta SQL
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':direccion', $direccion);
            $stmt->execute(); // 5. Ejecutamos la consulta SQL

            return $conn->lastInsertId(); // 6. Retornamos el id del registro insertado

        } catch (PDOException $e) {
            //echo "Error: " . $e->getMessage();
            return null;
        }
    }

    function actualizarCliente($id,$nombre,$correo,$telefono,$direccion){
        try{
            $conn = conectar();// 1. Conectamos a la base de datos

            $sql = "UPDATE clientes SET 
                    nombre = :nombre,
                    correo = :correo,
                    telefono = :telefono,
                    direccion = :direccion
                    WHERE id = :id"; // 2. Definimos la consulta SQL

            $stmt = $conn->prepare($sql); // 3. Preparamos la consulta SQL
            $stmt->bindParam(':nombre', $nombre); // 4. Asignamos un valor a cada parametro
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':direccion', $direccion);
            $stmt->bindParam(':id', $id);
            $stmt->execute(); // 5. Ejecutamos la consulta SQL

            return $stmt->rowCount(); // 6. Retornamos el numero de registros actualizados

        } catch (PDOException $e) {
            //echo "Error: " . $e->getMessage();
            return null;
        }

    }

    function eliminarCliente($id): int {
        try {
            $conn = conectar();
            
            // 1. Primero verificamos si el cliente existe
            $sql = "SELECT * FROM clientes WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $cliente = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (!$cliente) {
                return 0; // Cliente no encontrado
            }
            
            // 2. Eliminamos de la tabla clientes
            $sql = "DELETE FROM clientes WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            
            // 3. Verificamos si se eliminó correctamente
            if ($stmt->rowCount() > 0) {
                return 1;
            }
            
            return 0;

        } catch (PDOException $e) {
            error_log("Error al eliminar cliente: " . $e->getMessage());
            return 0;
        }
    }

    function mostrarCliente($id){
        
        try{
            $conn = conectar();// 1. Conectamos a la base de datos

            $sql = "SELECT * FROM clientes WHERE id = :id"; // 2. Definimos la consulta SQL

            $stmt = $conn->prepare($sql); // 3. Preparamos la consulta SQL
            $stmt->bindParam(':id', $id); // 4. Asignamos un valor a cada parametro
            $stmt->execute(); // 5. Ejecutamos la consulta SQL

            return $stmt->fetch(); // 6. Obtenemos el registro

        } catch (PDOException $e) {
            //echo "Error: " . $e->getMessage();
            return null;
        }

    }

    function mostrarClientes() {
        try {
            $conn = conectar();
            $sql = "SELECT id, nombre, correo, telefono, direccion FROM clientes";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }
    
?>