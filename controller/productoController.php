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

    public function removeProduct()
    {
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

    public function insertarDetallesPedido()
    {
        include_once 'config/parametros.php';

        // Asegúrate de haber iniciado la sesión
        session_start();

        // Obtén la conexión a la base de datos
        $conn = DataBase::connect(); // Ajusta según tu clase de conexión

        // Variable para almacenar el ID del usuario
        $idUsuario = 0;

        // Verifica si 'email' está definido en la sesión
        if (isset($_SESSION['email'])) {
            // Obtiene el correo electrónico de la sesión
            $emailUsuario = $_SESSION['email'];

            // Realiza una consulta para obtener el ID del usuario basado en el correo electrónico
            $sql = "SELECT ID_USUARIO FROM usuarios WHERE CORREO = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('s', $emailUsuario);

            // Ejecuta la consulta
            $stmt->execute();
            $result = $stmt->get_result();

            // Verifica si se obtuvo un resultado
            if ($result) {
                // Verifica si se encontró un usuario con el correo electrónico proporcionado
                if ($result->num_rows > 0) {
                    // Obtiene el ID del usuario
                    $row = $result->fetch_assoc();
                    $idUsuario = $row['ID_USUARIO'];
                } else {
                    // Maneja el caso en que no se encuentre ningún usuario con el correo electrónico proporcionado
                    echo "No se encontró ningún usuario con el correo electrónico proporcionado.";
                }
            } else {
                // Maneja el caso en que haya un problema con la consulta SQL
                echo "Error en la consulta SQL: " . $stmt->error;
            }

            // Cierra la consulta
            $stmt->close();
        } else {
            // Maneja el caso en que 'email' no está definido en la sesión
            echo "El índice 'email' no está definido en la sesión.";
        }

        try {
            // Inicia una transacción
            $conn->begin_transaction();

            // Insertar datos en la tabla pedidos
            $sqlPedido = "INSERT INTO pedidos (ID_USUARIO, ESTADO, FECHA_PEDIDO) VALUES (?, 'Pendiente', NOW())";
            $stmtPedido = $conn->prepare($sqlPedido);
            $stmtPedido->bind_param('i', $idUsuario);
            $stmtPedido->execute();

            // Obtener el ID del pedido recién insertado
            $idPedido = $conn->insert_id;

            // Insertar detalles del producto en la tabla pedido_articulos
            $sqlDetallePedido = "INSERT INTO pedido_articulos (ID_PEDIDO, ID_PRODUCTO, CANTIDAD, PRECIO) VALUES (?, ?, ?, ?)";
            $stmtDetallePedido = $conn->prepare($sqlDetallePedido);
            $stmtDetallePedido->bind_param('iiid', $idPedido, $idProducto, $cantidad, $precio);

            // Verifica si hay productos en la sesión
            if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                $productos = $_SESSION['cart'];

                foreach ($productos as $producto) {
                    $idProducto = $producto['id'];
                    $cantidad = $producto['quantity'];
                    $precio = $producto['price'];

                    $stmtDetallePedido->execute();
                }

                // Commit de la transacción
                $conn->commit();

                // Limpiar el carrito después de procesar el pedido
                unset($_SESSION['cart']);

                // Redirige al usuario al dashboard
                header("Location: " . $url . "?controller=usuario&action=dashboard");
                exit; // Asegura que no haya ninguna salida adicional después de la redirección
            } else {
                echo "No hay productos en el carrito.";
            }
        } catch (Exception $e) {
            // Rollback de la transacción en caso de error
            $conn->rollback();
            echo "Error al insertar detalles del pedido: " . $e->getMessage();
        } finally {
            // Verifica si $stmtDetallePedido está definido antes de cerrarlo
            if (isset($stmtDetallePedido)) {
                $stmtDetallePedido->close();
            }
            $stmtPedido->close();
            $conn->close();
        }
    }





}
?>