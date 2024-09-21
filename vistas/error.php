<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
    <link rel="stylesheet" href="css/styles_inicio.css">
</head>
<body>
    <header>
        <h1>Error</h1>
    </header>
    <main>
        <p><?php echo htmlspecialchars($error); ?></p>
        <a href="index.php">Regresar al inicio</a>
    </main>
    <footer>
        <p>&copy; 2024 El Pollo Más Wey</p>
    </footer>
</body>
</html>
