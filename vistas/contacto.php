<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto - Mi Empresa</title>
    <link rel="stylesheet" href="/desarrollo-web/Proyecto-FacturaPollo/vistas/css/styles_contacto.css">
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
        <h2>Contacto</h2>
        <form action="index.php?action=contacto" method="post">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="correo">Correo Electrónico:</label>
                <input type="email" id="correo" name="correo" required>
            </div>
            <div class="form-group">
                <label for="mensaje">Mensaje:</label>
                <textarea id="mensaje" name="mensaje" required></textarea>
            </div>
            <button type="submit" class="btn">Enviar</button>
        </form>
        <?php if (isset($mensajeExito)): ?>
            <p class="mensaje-exito"><?php echo htmlspecialchars($mensajeExito); ?></p>
        <?php endif; ?>
        <?php if (isset($mensajeError)): ?>
            <p class="mensaje-error"><?php echo htmlspecialchars($mensajeError); ?></p>
        <?php endif; ?>
    </main>

    <footer class="footer">
        <p>&copy; 2024 El Pollo Mas Wey. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
