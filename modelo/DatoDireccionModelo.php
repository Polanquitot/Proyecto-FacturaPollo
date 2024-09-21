<?php

class DatoDireccionModelo {
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

    public function obtenerDireccionesPorCliente($id_cliente) {
        $stmt = $this->pdo->prepare('SELECT * FROM dato_direccion WHERE id_cliente = :id_cliente');
        $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
