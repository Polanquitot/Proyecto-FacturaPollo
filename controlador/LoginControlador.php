<?php
require_once 'UsuarioModelo.php';

class LoginControlador {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $correo = $_POST['correo'];
            $pass = $_POST['pass'];

            $UsuarioModelo = new UsuarioModelo();
            $usuario = $UsuarioModelo->obtenerUsuarioPorCorreo($correo);

            if ($usuario && password_verify($pass, $usuario['pass'])) {
                header('Location: index.php?action=home');
                exit();
            } else {
                $error = 'Correo electrónico o contraseña incorrectos.';
                require 'vistas/login.php';
                return;
            }
        }

        require 'vistas/login.php';
    }
}
?>
