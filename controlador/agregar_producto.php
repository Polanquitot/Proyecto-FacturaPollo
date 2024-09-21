<?php
require_once 'modelo/ProductoModelo.php';

$host = 'localhost';
$db = 'ventas_electrodomesticos';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
        $descripcion = filter_input(INPUT_POST, 'descripcion', FILTER_SANITIZE_STRING);
        $precio = filter_input(INPUT_POST, 'precio', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $imagen = $_FILES['imagen']['name'];
        $imagenTmp = $_FILES['imagen']['tmp_name'];
        $uploadDir = __DIR__ . '/vistas/img/productos/';
        $uploadFile = $uploadDir . basename($imagen);

        if ($_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            if (move_uploaded_file($imagenTmp, $uploadFile)) {
                $stmt = $pdo->prepare("INSERT INTO producto (nombre, descripcion, precio, imagen) VALUES (:nombre, :descripcion, :precio, :imagen)");
                $stmt->bindParam(':nombre', $nombre);
                $stmt->bindParam(':descripcion', $descripcion);
                $stmt->bindParam(':precio', $precio);
                $stmt->bindParam(':imagen', $imagen);
                
                if ($stmt->execute()) {
                    header('Location: exito.php');
                    exit();
                } else {
                    header('Location: error.php');
                    exit();
                }
            } else {
                echo "Error al subir la imagen.";
            }
        } else {
            echo "Error en la carga del archivo: " . $_FILES['imagen']['error'];
        }
    }
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>
