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

    public function crearProducto()
    {

        include_once "views/crearProducto.php";


    }

    public function Reseñas()
    {

        include_once "views/reseñas.php";


    }


    public function QR()
    {

        include_once "views/qrPage.php";


    }


    public static function sel()
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

                // Guardar el ID del último pedido en una cookie
                setcookie('ultimo_pedido', $idPedido, time() + 3600, '/'); // La cookie expirará en 1 hora

                // Obtener el valor de la propina desde el formulario
                $propina = isset($_POST['propina']) ? $_POST['propina'] : 0;

                // Actualizar el pedido con el valor de la propina
                $sqlActualizarPedido = "UPDATE pedidos SET PROPINA = ? WHERE ID_PEDIDO = ?";
                $stmtActualizarPedido = $conn->prepare($sqlActualizarPedido);
                $stmtActualizarPedido->bind_param('di', $propina, $idPedido);
                $stmtActualizarPedido->execute();

                // Commit de la transacción
                $conn->commit();

                // Limpiar el carrito después de procesar el pedido
                unset($_SESSION['cart']);

                // Redirige al usuario al dashboard
                header("Location: " . $url . "?controller=producto&action=dashboard");
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


    public static function mostrarUltimoPedido()
    {
        // Verifica si la cookie 'ultimo_pedido' está definida
        if (isset($_COOKIE['ultimo_pedido'])) {
            // Obtiene el valor de la cookie 'ultimo_pedido'
            $ultimoPedidoInfo = $_COOKIE['ultimo_pedido'];

            return $ultimoPedidoInfo;
        } else {

        }
    }

    public static function obtenerDetallesDelPedido2()
    {
        // Obtener el último pedido
        $ultimoPedidoInfo = self::mostrarUltimoPedido();

        // Realizar la conexión a la base de datos (reemplazar los valores según sea necesario)
        $con = DataBase::connect();

        // Verificar la conexión
        if ($con->connect_error) {
            die("Conexión fallida: " . $con->connect_error);
        }

        // Consulta SQL para obtener los detalles del pedido
        $sql = "SELECT pa.ID_PRODUCTO, p.NOMBRE_PRODUCTO, p.IMG, pa.CANTIDAD, pa.PRECIO 
    FROM pedido_articulos pa
    INNER JOIN productos p ON pa.ID_PRODUCTO = p.ID_PRODUCTO
    WHERE pa.ID_PEDIDO = $ultimoPedidoInfo";

        // Ejecutar la consulta
        $result = $con->query($sql);

        // Verificar si hay resultados
        if ($result->num_rows > 0) {
            // Crear un array para almacenar los detalles del pedido
            $detallesPedido = array();

            // Recorrer los resultados y agregar los detalles al array
            while ($row = $result->fetch_assoc()) {
                $detallesPedido[] = $row;
            }

            // Cerrar la conexión y devolver el array de detalles del pedido
            $con->close();
            return $detallesPedido;
        } else {
            // Si no hay resultados, cerrar la conexión y devolver un array vacío
            $con->close();
            return array();
        }
    }




    public static function recuperarPedido($idPedido)
    {
        // Obtener detalles del pedido
        $detallesPedido = productoController::obtenerDetallesDelPedido($idPedido);

        // Verificar si hay detalles de pedido
        if (!empty($detallesPedido)) {
            // Recorrer los detalles del pedido y agregar cada producto al carrito
            foreach ($detallesPedido as $detalle) {
                $idProducto = $detalle['ID_PRODUCTO'];
                $cantidad = $detalle['CANTIDAD'];

                // Obtener los detalles del producto
                $productoDetalles = productoController::obtenerDetallesProducto($idProducto);

                // Verificar si se obtuvieron detalles del producto
                if (!empty($productoDetalles)) {
                    // Agregar producto al carrito
                    self::agregarProductoAlCarrito($productoDetalles, $cantidad);
                } else {
                    // Manejar el caso en que no se obtuvieron detalles del producto
                    echo "Error: No se encontraron detalles del producto con ID $idProducto.";
                }
            }

            // Redirigir a la página del carrito o a donde sea necesario
            header("Location: ?controller=producto&action=Carrito");
            exit();
        } else {
            // Manejar el caso en que no haya detalles de pedido
            echo "Error: No se encontraron detalles de pedido.";
        }
    }

    public static function obtenerDetallesProducto($idProducto)
    {
        // Obtén la conexión a la base de datos y otras configuraciones necesarias
        $conn = DataBase::connect(); // Ajusta según tu clase de conexión

        // Inicializa un array para almacenar los detalles del producto
        $detallesProducto = array();

        // Consulta para obtener detalles del producto
        $sql = "SELECT ID_PRODUCTO, NOMBRE_PRODUCTO, PRECIO, IMG, DESCRIPCION FROM productos WHERE ID_PRODUCTO = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $idProducto);

        // Ejecuta la consulta
        $stmt->execute();

        // Obtiene el resultado de la consulta
        $result = $stmt->get_result();

        // Verifica si se obtuvo un resultado
        if ($result) {
            // Obtiene los detalles del producto
            $detallesProducto = $result->fetch_assoc();
        } else {
            // Maneja el caso en que haya un problema con la consulta SQL
            echo "Error en la consulta SQL: " . $stmt->error;
        }

        // Cierra la consulta y la conexión
        $stmt->close();
        $conn->close();

        // Devuelve los detalles del producto
        return $detallesProducto;
    }

    public static function agregarProductoAlCarrito($detallesProducto, $cantidad)
    {
        include_once 'config/parametros.php';

        // Inicia o recupera la sesión
        session_start();

        // Verifica si el carrito está definido en la sesión
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

        // Construye el array de producto
        $producto = array(
            'id' => $detallesProducto['ID_PRODUCTO'],
            'name' => $detallesProducto['NOMBRE_PRODUCTO'],
            'price' => $detallesProducto['PRECIO'],
            'img' => $detallesProducto['IMG'],
            'description' => $detallesProducto['DESCRIPCION'],
            'quantity' => $cantidad
        );

        // Agrega el producto al carrito
        $_SESSION['cart'][] = $producto;
    }

    public static function ajustarCantidadProducto($productoId, $nuevaCantidad)
    {
        include_once 'config/parametros.php';

        // Inicia o recupera la sesión
        session_start();

        // Verifica si el carrito está definido en la sesión
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

        // Encuentra el índice del producto en el carrito
        $indiceProducto = -1;
        foreach ($_SESSION['cart'] as $indice => $producto) {
            if ($producto['id'] == $productoId) {
                $indiceProducto = $indice;
                break;
            }
        }

        // Ajusta la cantidad si se encontró el producto en el carrito
        if ($indiceProducto !== -1) {
            // Asegúrate de que la nueva cantidad sea al menos 1
            $nuevaCantidad = max(1, $nuevaCantidad);

            // Actualiza la cantidad del producto en el carrito
            $_SESSION['cart'][$indiceProducto]['quantity'] = $nuevaCantidad;
        }
    }


    public static function obtenerDetallesDelPedido($idPedido)
    {
        // Obtén la conexión a la base de datos y otras configuraciones necesarias
        $conn = DataBase::connect(); // Ajusta según tu clase de conexión

        // Inicializa un array para almacenar los detalles del pedido
        $detallesPedido = array();

        // Consulta para obtener detalles del pedido
        $sql = "SELECT ID_PRODUCTO, CANTIDAD, PRECIO FROM pedido_articulos WHERE ID_PEDIDO = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $idPedido);

        // Ejecuta la consulta
        $stmt->execute();

        // Obtiene el resultado de la consulta
        $result = $stmt->get_result();

        // Verifica si se obtuvo un resultado
        if ($result) {
            // Recorre los resultados y agrega cada detalle al array
            while ($row = $result->fetch_assoc()) {
                $detallesPedido[] = array(
                    'ID_PRODUCTO' => $row['ID_PRODUCTO'],
                    'CANTIDAD' => $row['CANTIDAD'],
                    'PRECIO' => $row['PRECIO']
                    // Puedes agregar más campos según sea necesario
                );
            }
        } else {
            // Maneja el caso en que haya un problema con la consulta SQL
            echo "Error en la consulta SQL: " . $stmt->error;
        }

        // Cierra la consulta y la conexión
        $stmt->close();
        $conn->close();

        // Devuelve los detalles del pedido
        return $detallesPedido;
    }



    public function modificarProducto($idProducto)
    {
        // Obtener detalles del producto por su ID
        $detallesProducto = productoDAO::getProductoById($idProducto);

        // Llamar a la vista con los detalles del producto
        include 'views/modificarProducto.php';
    }

    // Dentro de productoController.php

    public function procesarModificarProducto()
    {
        // Verifica si se han enviado los datos del formulario
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtén los datos del formulario
            $idProducto = $_POST['idProducto'];
            $nombreProducto = $_POST['nombreProducto'];
            $descripcion = $_POST['descripcion'];
            $precio = $_POST['precio'];
            $cantidad = $_POST['cantidad'];
            $img = $_POST['img'];
            $idCategoria = $_POST['idCategoria'];

            // Llama a la función que actualiza el producto en la base de datos
            productoDAO::actualizarProducto($idProducto, $nombreProducto, $descripcion, $precio, $cantidad, $img, $idCategoria);

            // Redirige a la página de productos (o a donde desees)
            header("Location: ?controller=usuario&action=adminPage");
            exit();
        } else {
            // Si no se enviaron los datos por POST, redirige a la página principal
            header("Location: ?controller=usuario&action=adminPage");
            exit();
        }
    }

    public function eliminarProducto()
    {
        // Verifica si se ha proporcionado un ID de producto
        if (isset($_GET['id'])) {
            $idProducto = $_GET['id'];

            // Llama a la función que elimina el producto en la base de datos
            productoDAO::eliminarProducto($idProducto);

            // Redirige al usuario al mismo lugar
            header("Location: ?controller=usuario&action=adminPage");
            exit();
        } else {
            // Si no se proporcionó un ID de producto, redirige a la página principal
            header("Location: ?controller=usuario&action=adminPage");
            exit();
        }
    }

    public function procesarCrearProducto()
    {
        // Verifica si se han enviado los datos del formulario
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtén los datos del formulario
            $idCategoria = $_POST['idCategoria'];
            $nombreProducto = $_POST['nombreProducto'];
            $descripcion = $_POST['descripcion'];
            $precio = $_POST['precio'];
            $cantidad = $_POST['cantidad'];
            $img = $_POST['img'];

            // Puedes realizar validaciones aquí

            // Llama a la función que crea el producto en la base de datos
            productoDAO::crearProducto($idCategoria, $nombreProducto, $descripcion, $precio, $cantidad, $img);

            // Redirige a la página de productos (o a donde desees)
            header("Location: ?controller=producto&action=adminPage");
            exit();
        } else {
            // Si no se enviaron los datos por POST, redirige a la página principal
            header("Location: ?controller=producto&action=adminPage");
            exit();
        }
    }












}
?>