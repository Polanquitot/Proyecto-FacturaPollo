<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array();
}

require_once 'modelo/ProductoModelo.php';

$ProductoModelo = new ProductoModelo();
$productos = array();
$total = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['producto_id'])) {
    $producto_id = $_POST['producto_id'];
    $_SESSION['carrito'][] = $producto_id;
}

foreach ($_SESSION['carrito'] as $producto_id) {
    $producto = $ProductoModelo->obtenerProductoPorId($producto_id);
    if ($producto) {
        $productos[] = $producto;
        $total += $producto['precio'];
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
    <link rel="stylesheet" href="/desarrollo-web/Proyecto-FacturaPollo/vistas/css/styles_carrito.css">
</head>
<body>
   <header>
        <div class="navbar">
            <div class="navbar-left">
                <a href="index.php?action=home" class="nav-link">Inicio</a>
                <a href="index.php?action=contacto" class="nav-link">Contacto</a>
                <a href="index.php?action=nosotros" class="nav-link">Nosotros</a>
            </div>
            <div class="navbar-right">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="index.php?action=perfil" class="nav-link">Perfil</a>
                <?php endif; ?>
                <a href="<?php echo isset($_SESSION['user_id']) ? 'index.php?action=carrito' : 'index.php?action=login'; ?>" class="nav-link">Carrito</a>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="index.php?action=logout" class="nav-link">Salir</a>
                <?php else: ?>
                    <a href="index.php?action=login" class="nav-link">Iniciar Sesión</a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <main>
        <div class="products-container">
            <h2>Carrito de Compras</h2>
            <div class="products">
                <?php if (!empty($productos)): ?>
                    <?php foreach ($productos as $producto): ?>
                        <div class="product-card">
                            <img src="/desarrollo-web/Proyecto-FacturaPollo/vistas/img/productos/<?php echo htmlspecialchars($producto['imagen']); ?>" alt="<?php echo htmlspecialchars($producto['nombre']); ?>">
                            <div class="product-info">
                                <h3><?php echo htmlspecialchars($producto['nombre']); ?></h3>
                                <p><?php echo htmlspecialchars($producto['descripcion']); ?></p>
                                <p>Q<?php echo number_format($producto['precio'], 2); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="total">
                        <h3>Total: Q<?php echo number_format($total, 2); ?></h3>
                    </div>
                <?php else: ?>
                    <p>No hay productos en el carrito.</p>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <footer>
        <div class="footer-content">
            <p>&copy; 2024 El Pollo Más Wey. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
</html>
