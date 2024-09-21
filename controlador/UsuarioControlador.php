<?php
require_once 'UsuarioModelo.php';

class UsuarioControlador {
    public function registrar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $telefono = $_POST['telefono'];
            $nit = $_POST['nit'];
            $correo = $_POST['correo'];
            $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);

            try {
                $UsuarioModelo = new UsuarioModelo();
                $UsuarioModelo->crearUsuario($nombre, $apellido, $telefono, $nit, $correo, $pass);
                $mensaje = 'Usuario registrado exitosamente.';
                require 'vistas/login.php'; 
            } catch (Exception $e) {
                $error = $e->getMessage();
                require 'vistas/registro.php'; 
            }
        } else {
            require 'vistas/registro.php'; 
        }
    }
}
?>
