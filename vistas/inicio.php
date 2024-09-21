<?php
require_once 'init.php'; 
require_once 'modelo/ProductoModelo.php';
require_once 'modelo/UsuarioModelo.php';

$ProductoModelo = new ProductoModelo();
$productos = $ProductoModelo->obtenerProductos();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="/desarrollo-web/Proyecto-FacturaPollo/vistas/css/styles_inicio.css">
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
    <section class="Ofertas">
        <center><h2>OFERTAS</h2></center>
        <div class="gallery-container">
            <?php if (!empty($productos)): ?>
                <?php foreach ($productos as $producto): ?>
                    <div class="gallery-item">
                        <img src="/desarrollo-web/Proyecto-FacturaPollo/vistas/img/productos/<?php echo htmlspecialchars($producto['imagen']); ?>" alt="<?php echo htmlspecialchars($producto['nombre']); ?>">
                        <div class="gallery-caption">
                            <h3 class="product-name"><?php echo htmlspecialchars($producto['nombre']); ?></h3>
                            <p class="product-marca"><?php echo htmlspecialchars($producto['marca']); ?></p>
                            <p class="product-description"><?php echo htmlspecialchars($producto['descripcion']); ?></p>
                            <p class="product-price">Precio: Q<?php echo number_format($producto['precio'], 2); ?></p>
                            <p class="product-weight">Peso: <?php echo htmlspecialchars($producto['peso']); ?> kg</p>
                        </div>
                        
                       <form action="carrito.php" method="post" class="add-to-cart-form">
                            <input type="hidden" name="producto_id" value="<?php echo htmlspecialchars($producto['id']); ?>">
                            <button type="submit" class="add-to-cart-btn">Agregar al carrito</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No hay productos disponibles.</p>
            <?php endif; ?>
        </div>
    </section>
</main>

<footer>
    <div class="footer-content">
        <p>&copy; 2024 El Pollo Más Wey. Todos los derechos reservados.</p>
    </div>
</footer>
</body>
</html>
