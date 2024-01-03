<?php

include_once 'controller/productoController.php';
include_once 'controller/usuarioController.php';
include_once 'config/parametros.php';

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

    // Verifica si la acción es 'visualizarPedido' y si hay un parámetro 'ID_PEDIDO'
    if ($action == 'visualizarPedido') {
        // Asegúrate de que estás pasando el ID del pedido si está disponible
        if (!isset($_GET['ID_PEDIDO'])) {
            // Manejar el caso en que no hay ID de pedido disponible
            echo "Error: ID del pedido no proporcionado.";
            exit();
        }

        $idPedido = $_GET['ID_PEDIDO'];
        $controller->$action($idPedido);
        exit();
    }

    // Si la acción es 'recuperarPedido', asegúrate de que estás pasando el ID del pedido
    if ($action == 'recuperarPedido') {
        if (!isset($_GET['ID_PEDIDO'])) {
            // Manejar el caso en que no hay ID de pedido disponible
            echo "Error: ID del pedido no proporcionado.";
            exit();
        }

        $idPedidoRecuperar = $_GET['ID_PEDIDO'];

        // Llama a la función recuperarPedidoEnCarrito del controlador de productos
        productoController::recuperarPedido($idPedidoRecuperar);

        // Después de llamar a recuperarPedidoEnCarrito, redirige al usuario a la página del carrito
        header("Location: " . url . "?controller=producto&action=carrito");
        exit();
    }

    // Si la acción es 'modificarProducto', verifica si se proporciona el ID del producto
    if ($action == 'modificarProducto') {
        if (!isset($_GET['id'])) {
            // Manejar el caso en que no se proporciona el ID del producto
            echo "Error: ID del producto no proporcionado.";
            exit();
        }

        $idProductoModificar = $_GET['id'];
        $controller->$action($idProductoModificar);
        exit();
    }

    // Si no es 'visualizarPedido', 'recuperarPedido' ni 'modificarProducto', llama a la acción sin argumentos
    $controller->$action();
} else {
    // Si no se proporciona una acción o la acción no es válida, ejecuta la acción 'index'
    $controller->index();
}

?>