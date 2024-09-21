<?php

class UsuarioModelo {
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

    public function obtenerUsuarioPorCorreo($correo) {
        $stmt = $this->pdo->prepare('SELECT * FROM login_cliente WHERE correo = :correo');
        $stmt->bindParam(':correo', $correo);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function obtenerUsuarioPorId($id) {
        $stmt = $this->pdo->prepare('SELECT * FROM cliente WHERE id_cliente = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function crearUsuario($nombre, $apellido, $telefono, $nit, $correo, $pass) {
        $this->pdo->beginTransaction();
        try {
            // Insertar en la tabla cliente
            $stmt = $this->pdo->prepare('INSERT INTO cliente (nombre, apellido, telefono, nit) VALUES (:nombre, :apellido, :telefono, :nit)');
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':apellido', $apellido);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':nit', $nit);
            $stmt->execute();

            $id_cliente = $this->pdo->lastInsertId();

            // Encriptar la contraseña
            $pass_hash = password_hash($pass, PASSWORD_BCRYPT);

            // Insertar en la tabla login_cliente
            $stmt = $this->pdo->prepare('INSERT INTO login_cliente (id_cliente, correo, pass) VALUES (:id_cliente, :correo, :pass)');
            $stmt->bindParam(':id_cliente', $id_cliente);
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':pass', $pass_hash);
            $stmt->execute();

            $this->pdo->commit();
        } catch (Exception $e) {
            $this->pdo->rollBack();
            throw $e;
        }
    }

    public function existeCorreo($correo) {
        $stmt = $this->pdo->prepare('SELECT id_cliente FROM login_cliente WHERE correo = :correo');
        $stmt->bindParam(':correo', $correo);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    public function actualizarUsuario($id, $nombre, $apellido, $telefono, $nit) {
        $stmt = $this->pdo->prepare('UPDATE cliente SET nombre = :nombre, apellido = :apellido, telefono = :telefono, nit = :nit WHERE id_cliente = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':nit', $nit);
        $stmt->execute();
    }

    public function actualizarContrasena($id_cliente, $nueva_contrasena) {
        $pass_hash = password_hash($nueva_contrasena, PASSWORD_BCRYPT);
        $stmt = $this->pdo->prepare('UPDATE login_cliente SET pass = :pass WHERE id_cliente = :id_cliente');
        $stmt->bindParam(':id_cliente', $id_cliente);
        $stmt->bindParam(':pass', $pass_hash);
        $stmt->execute();
    }

    public function eliminarUsuario($id_cliente) {
        $this->pdo->beginTransaction();
        try {
            // Eliminar de la tabla login_cliente
            $stmt = $this->pdo->prepare('DELETE FROM login_cliente WHERE id_cliente = :id_cliente');
            $stmt->bindParam(':id_cliente', $id_cliente);
            $stmt->execute();

            // Eliminar de la tabla cliente
            $stmt = $this->pdo->prepare('DELETE FROM cliente WHERE id_cliente = :id_cliente');
            $stmt->bindParam(':id_cliente', $id_cliente);
            $stmt->execute();

            $this->pdo->commit();
        } catch (Exception $e) {
            $this->pdo->rollBack();
            throw $e;
        }
    }
}
?>
