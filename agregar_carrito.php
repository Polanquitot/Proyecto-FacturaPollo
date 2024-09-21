<?php
session_start();  

if(!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array();  
}


$producto_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($producto_id > 0) {
    
    if (!in_array($producto_id, $_SESSION['carrito'])) {
        $_SESSION['carrito'][] = $producto_id;
    }
}


header('Location: index.php?action=carrito');
exit();
?>
