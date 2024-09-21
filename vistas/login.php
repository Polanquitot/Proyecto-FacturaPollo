<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="/desarrollo-web/Proyecto-FacturaPollo/vistas/css/styles.css">
</head>
<body>
    <div class="form-container">
        <h2>Iniciar Sesión</h2>
        <?php if (isset($error)): ?>
            <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <form action="index.php?action=login" method="post">
            <input type="email" name="correo" placeholder="Correo electrónico" required>
            <input type="password" name="pass" placeholder="Contraseña" required>
            <input type="submit" value="Iniciar Sesión">
        </form>
        <div class="form-link">
            <a href="index.php?action=register">Crear una cuenta</a>
        </div>
    </div>
</body>
</html>
