<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nosotros</title>
    <link rel="stylesheet" href="/desarrollo-web/Proyecto-FacturaPollo/vistas/css/styles_inicio.css">
</head>
<body>
    <div class="main-container">
        <header>
            <div class="navbar">
                <div class="navbar-left">
                    <a href="index.php?action=home" class="nav-link">Inicio</a>
                    <a href="index.php?action=contacto" class="nav-link">Contacto</a>
                    <a href="index.php?action=nosotros" class="nav-link">Nosotros</a>
                </div>
                <div class="navbar-right">
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
            <div class="nosotros-container">
              <center>  <h2>Nosotros</h2>  </center> 
                 <center>  <p>Bienvenidos a El Pollo Más Wey. Somos una empresa dedicada a ofrecer los mejores productos de electrodomésticos.</p> </center> 
              <center>     <p>Con años de experiencia en el sector, nos enorgullecemos de proporcionar productos de alta calidad y un excelente servicio al cliente.</p>  </center> 
                 <center>  <p>Nuestra misión es hacer que cada experiencia de compra sea excepcional y satisfactoria.</p>  </center> 
            </div>
        </main>

        <footer>
            <div class="footer-content">
                <p>&copy; 2024 El Pollo Más Wey. Todos los derechos reservados.</p>
            </div>
        </footer>
    </div>
</body>
</html>