<?php
    include_once 'conexion.php';

    function auth($usuario,$password){
        try{
            $conn = conectar();
            if (!$conn) {
                error_log("Error de conexión en auth()");
                return null;
            }

            $sql = "SELECT * FROM administradores WHERE usuario = :usuario AND password = :password";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':usuario',$usuario);
            $stmt->bindParam(':password',$password);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? $result : null;

        } catch (PDOException $e) {
            error_log("Error en auth(): " . $e->getMessage());
            return null;
        }
    }
