<?php

include_once 'controller/productoController.php';
include_once 'controller/usuarioController.php';
include_once 'controller/APIController.php';
include_once 'config/parametros.php';


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Verifica si se proporciona un controlador
if (!isset($_GET['controller'])) {
    header("location:" . url . '?controller=producto');
    exit();
}

$nombre_controller = $_GET['controller'] . 'Controller';

// Verifica si la clase del controlador existe
if (!class_exists($nombre_controller)) {
    header("location:" . url . '?controller=pedido');
    exit();
}

$controller = new $nombre_controller;

// Verifica si se proporciona una acción y si la acción es válida para el controlador
if (isset($_GET['action']) && method_exists($controller, $_GET['action'])) {
    $action = $_GET['action'];

    // Algunas acciones específicas que requieren manejo especial
    if ($action == 'visualizarPedido') {
        // Asegúrate de que estás pasando el ID del pedido si está disponible
        if (!isset($_GET['ID_PEDIDO'])) {
            echo "Error: ID del pedido no proporcionado.";
            exit();
        }

        $idPedido = $_GET['ID_PEDIDO'];
        $controller->$action($idPedido);
        exit();
    } elseif ($action == 'recuperarPedido') {
        // Asegúrate de que estás pasando el ID del pedido
        if (!isset($_GET['ID_PEDIDO'])) {
            echo "Error: ID del pedido no proporcionado.";
            exit();
        }

        $idPedidoRecuperar = $_GET['ID_PEDIDO'];
        productoController::recuperarPedido($idPedidoRecuperar);
        header("Location: " . url . "?controller=producto&action=carrito");
        exit();
    } elseif ($action == 'modificarProducto') {
        // Verifica si se proporciona el ID del producto
        if (!isset($_GET['id'])) {
            echo "Error: ID del producto no proporcionado.";
            exit();
        }

        $idProductoModificar = $_GET['id'];
        $controller->$action($idProductoModificar);
        exit();

    } elseif ($action == 'AñadirReseña') {
        // Asegúrate de que estás pasando el ID del pedido si está disponible
        if (!isset($_GET['ID_PEDIDO'])) {
            echo "Error: ID del pedido no proporcionado.";
            exit();
        }

        $idPedido = $_GET['ID_PEDIDO'];
        $controller->$action($idPedido);
        exit();
    }


    // Si no es una acción especial, llama a la acción sin argumentos
    $controller->$action();
} else {
    // Si no se proporciona una acción o la acción no es válida, ejecuta la acción 'index'
    $controller->index();
}
?>