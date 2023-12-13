<?php

include_once 'controller/productoController.php';
include_once 'controller/usuarioController.php';  // Agregamos la inclusión del nuevo controlador
include_once 'config/parametros.php';

if (!isset($_GET['controller'])) {
    // Si no le pasamos nada se pasará a la página principal de pedidos
    header("location:" . url . '?controller=producto');

} else {
    $nombre_controller = $_GET['controller'] . 'Controller';

    if (class_exists($nombre_controller)) {
        // Miro si nos pasa una acción
        // En caso contrario, mostramos una acción por defecto

        $controller = new $nombre_controller;

        if (isset($_GET['action']) && method_exists($controller, $_GET['action'])) {
            $action = $_GET['action'];
        } else {
            $action = 'index';
        }

        $controller->$action();

    } else {
        // Si no existe el controlador, redirigimos a una página predeterminada
        header("location:" . url . '?controller=pedido');
    }
}
?>
