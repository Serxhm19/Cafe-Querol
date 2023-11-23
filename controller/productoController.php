<?php

//Creamos el controlador de pedidos
include_once 'model/productoDAO.php';

class productoController
{

    public function index()
    {
        include_once "views/home.php";
        $allProducts = productoDAO::getAllProducto();


    }


    public function carta()
    {
        include_once "views/cart.php";

    }

    public function carrito()
    {

        include_once "views/carrito.php";


    }

    public function sel()
    {
        include_once 'config/parametros.php';

        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
            $product_id = $_POST['product_id'];
            $product_name = $_POST['product_name'];
            $product_price = $_POST['product_price'];
            $product_img = $_POST['product_img'];
            $product_description = $_POST['product_description'];

            // Create an array to store the product details
            $product = array(
                'id' => $product_id,
                'name' => $product_name,
                'price' => $product_price,
                'img' => $product_img,
                'description' => $product_description
            );

            // Check if the cart array exists in the session
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = array();
            }

            // Add the product to the cart array
            $_SESSION['cart'][] = $product;

            // Redirect back to the carta page after adding the product to the cart
            header("Location: " . $url . "?controller=producto&action=carrito");
            exit();


        }
    }

    public function deleteAllCart()
    {
        include_once 'config/parametros.php';

        session_start();

        // Borrar el carrito de la sesión
        unset($_SESSION['cart']);

        // Redirigir de nuevo a la página del carrito o a donde desees después de borrar el carrito
        header("Location: " . $url . "?controller=producto&action=carrito");
        exit();
    }

}
?>