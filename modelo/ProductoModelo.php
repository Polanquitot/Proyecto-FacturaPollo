<?php

class ProductoModelo {
    private $pdo;

    public function __construct() {
        $host = 'localhost';
        $dbname = 'ventas_electrodomesticos';
        $username = 'root';  
        $password = '';  

        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Error de conexión: ' . $e->getMessage());
        }
    }

    public function obtenerProductos() {
        $stmt = $this->pdo->prepare('SELECT * FROM producto');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
?>