<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="/desarrollo-web/Proyecto-FacturaPollo/vistas/css/styles.css">
</head>
<body>
    <div class="form-container">
        <h2>Crear una Cuenta</h2>
        <?php if (isset($error)): ?>
            <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <form action="index.php?action=register" method="post">
            <input type="text" name="nombre" placeholder="Nombre" required>
            <input type="text" name="apellido" placeholder="Apellido" required>
            <input type="text" name="telefono" placeholder="Teléfono" required>
            <input type="text" name="nit" placeholder="NIT" required>
            <input type="email" name="correo" placeholder="Correo electrónico" required>
            <input type="password" name="pass" placeholder="Contraseña" required>
            <input type="submit" value="Registrarse">
        </form>
        <div class="form-link">
            <a href="index.php?action=login">Ya tengo una cuenta</a>
        </div>
    </div>
</body>
</html>
