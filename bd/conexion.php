<?php

function conectar(){

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "db_usuarios";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;

    } catch (PDOException $e) {
        //echo "Error: " . $e->getMessage();
        return null;
    }

}//end function conectar
?>