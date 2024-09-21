<?php
session_start();

require_once 'modelo/ProductoModelo.php';
require_once 'modelo/UsuarioModelo.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'home';

$ProductoModelo = new ProductoModelo();
$UsuarioModelo = new UsuarioModelo();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($action === 'login') {
        $correo = isset($_POST['correo']) ? trim($_POST['correo']) : '';
        $pass = isset($_POST['pass']) ? trim($_POST['pass']) : '';

        $usuario = $UsuarioModelo->obtenerUsuarioPorCorreo($correo);

        if ($usuario && password_verify($pass, $usuario['pass'])) {
            $_SESSION['user_id'] = $usuario['id_cliente'];
            header('Location: index.php?action=home');
            exit();
        } else {
            $error = 'Credenciales inválidas';
            require 'vistas/login.php';
            exit();
        }
    } elseif ($action === 'register') {
        $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
        $apellido = isset($_POST['apellido']) ? trim($_POST['apellido']) : '';
        $telefono = isset($_POST['telefono']) ? trim($_POST['telefono']) : '';
        $nit = isset($_POST['nit']) ? trim($_POST['nit']) : '';
        $correo = isset($_POST['correo']) ? trim($_POST['correo']) : '';
        $pass = isset($_POST['pass']) ? trim($_POST['pass']) : '';

        if (empty($nombre) || empty($apellido) || empty($telefono) || empty($nit) || empty($correo) || empty($pass)) {
            $error = 'Por favor complete todos los campos.';
            require 'vistas/registro.php';
            exit();
        }

        if ($UsuarioModelo->existeCorreo($correo)) {
            $error = 'El correo electrónico ya está en uso.';
            require 'vistas/registro.php';
            exit();
        }

        try {
            $UsuarioModelo->crearUsuario($nombre, $apellido, $telefono, $nit, $correo, $pass);
            header('Location: index.php?action=login');
            exit();
        } catch (Exception $e) {
            $error = 'Error al crear la cuenta: ' . $e->getMessage();
            require 'vistas/registro.php';
            exit();
        }
    }
}

$protected_actions = ['carrito', 'perfil'];
if (!isset($_SESSION['user_id']) && in_array($action, $protected_actions)) {
    header('Location: index.php?action=login');
    exit();
}

switch ($action) {
    case 'home':
        $productos = $ProductoModelo->obtenerProductos();
        require 'vistas/inicio.php';
        break;
    case 'login':
        require 'vistas/login.php';
        break;
    case 'register':
        require 'vistas/registro.php';
        break;
    case 'carrito':
        require 'vistas/carrito.php';
        break;
    case 'contacto':
        require 'vistas/contacto.php';
        break;
    case 'nosotros':
        require 'vistas/nosotros.php';
        break;
    case 'perfil':
        $usuario = $UsuarioModelo->obtenerUsuarioPorCorreo($_SESSION['user_id']);
        require 'vistas/perfil.php';
        break;
    case 'logout':
        session_unset();
        session_destroy();
        header('Location: index.php?action=home');
        exit();
    default:
        header('Location: index.php?action=home');
        exit();
}
?>
