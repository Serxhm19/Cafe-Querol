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

    public function bebidas()
    {
        include_once "views/cartaBebidas.php";

    }

    public function alimentacion()
    {
        include_once "views/cartaAlimentacion.php";

    }

    public function packs()
    {
        include_once "views/cartaPacks.php";

    }

    public function carrito()
    {

        include_once "views/carrito.php";


    }

    public function footer()
    {

        include_once "views/footer.php";


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
    
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = array();
            }
    
            $productIndex = array_search($product_id, array_column($_SESSION['cart'], 'id'));
    
            if ($productIndex !== false) {
                $_SESSION['cart'][$productIndex]['quantity'] += 1;
            } else {
                $product = array(
                    'id' => $product_id,
                    'name' => $product_name,
                    'price' => $product_price,
                    'img' => $product_img,
                    'description' => $product_description,
                    'quantity' => 1
                );
                $_SESSION['cart'][] = $product;
            }
    
            header("Location: " . $url . "?controller=producto&action=Carta");
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

    public function removeProduct() {
        include_once 'config/parametros.php';
        // Verificar si se recibió un ID de producto válido
        if (isset($_POST['productId'])) {
            $productId = $_POST['productId'];

            // Iniciar la sesión
            session_start();

            // Verificar si hay productos en el carrito
            if (!empty($_SESSION['cart'])) {
                // Buscar el producto por ID en el carrito y eliminarlo
                foreach ($_SESSION['cart'] as $index => $producto) {
                    if (isset($producto['id']) && $producto['id'] == $productId) {
                        // Eliminar el producto del carrito
                        unset($_SESSION['cart'][$index]);
                    }
                }
            }
        }

        // Redirigir a la página del carrito 
        header("Location: " . $url . "?controller=producto&action=carrito");
        exit();
    }


}
?>