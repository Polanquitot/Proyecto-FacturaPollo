<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica si el usuario está autenticado
if (isset($_SESSION['user_id'])) {
    $id_usuario = $_SESSION['user_id'];

    // Asegúrate de que la ruta al archivo UsuarioModelo.php sea correcta
    require_once __DIR__ . '/../modelo/UsuarioModelo.php';

    $usuarioModelo = new UsuarioModelo();
    $usuario = $usuarioModelo->obtenerUsuarioPorId($id_usuario);

    if ($usuario) {
        ?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
           <center> <title>Perfil del Usuario</title></center>
            <link rel="stylesheet" href="/desarrollo-web/Proyecto-FacturaPollo/vistas/css/styles_perfil.css">
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
            <div class="container">
                <h1>Perfil del Usuario</h1>
                <form class="profile-form">
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre" value="<?php echo htmlspecialchars($usuario['nombre']); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="apellido">Apellido:</label>
                        <input type="text" id="apellido" value="<?php echo htmlspecialchars($usuario['apellido']); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono:</label>
                        <input type="text" id="telefono" value="<?php echo htmlspecialchars($usuario['telefono']); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nit">NIT:</label>
                        <input type="text" id="nit" value="<?php echo htmlspecialchars($usuario['nit']); ?>" readonly>
                    </div>
                    
                </form>
            </div>
        </body>
        </html>
        <?php
    } else {
        echo '<p>Usuario no encontrado</p>';
    }
} else {
    echo '<p>No estás autenticado</p>';
}
?>
