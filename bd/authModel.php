<?php
    include_once 'conexion.php';

    function auth($usuario,$clave){
        try{
            $conn = conectar();
            if (!$conn) {

                error_log("Error de conexión en auth()");
                return null;
            }

            $sql = "SELECT * FROM administrador WHERE usuario = :usuario AND clave = :clave";


            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':usuario',$usuario);
            $stmt->bindParam(':clave',$clave);
            $stmt->execute();


            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? $result : null;

        } catch (PDOException $e) {
            error_log("Error en auth(): " . $e->getMessage());
            return null;
        }
    }
