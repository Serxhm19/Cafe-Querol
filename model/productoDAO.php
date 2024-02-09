<?php
include_once("config/db.php");

final class productoDAO
{
    public static function getAllProducto()
    {
        $con = DataBase::connect();
        $sql = "SELECT * FROM productos";

        if ($resultado = $con->query($sql)) {
            while ($productoDB = $resultado->fetch_object()) {
                $allproducts[] = $productoDB;
            }
            return $allproducts;
        }
    }
    public static function getProductoById($id)
    {
        $con = DataBase::connect();
        // Preparar la consulta con una sentencia preparada
        $sql = "SELECT * FROM productos WHERE ID_PRODUCTO = ?";
        $stmt = $con->prepare($sql);

        // Enlazar el valor al marcador de posición
        $stmt->bind_param("s", $id);

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener el resultado
        $resultado = $stmt->get_result();

        // Verificar si se obtuvieron resultados
        if ($resultado->num_rows > 0) {
            $producto = $resultado->fetch_object();
            return $producto;
        } else {
            return null; // No se encontraron resultados
        }
    }


    public static function getProductoBebidas($categoria)
    {
        $con = DataBase::connect();
        $sql = "SELECT * FROM productos WHERE ID_CATEGORIA = 1";

        $productos = array(); // Inicializamos un array para almacenar los productos

        if ($resultado = $con->query($sql)) {
            while ($producto = $resultado->fetch_object()) {
                $productos[] = $producto; // Agregamos cada producto al array
            }
            return $productos; // Devolvemos el array con todos los productos
        } else {
            return null; // Devolvemos null en caso de error en la consulta
        }
    }

    public static function getProductoAlimentacion($categoria)
    {
        $con = DataBase::connect();
        $sql = "SELECT * FROM productos WHERE ID_CATEGORIA = 2";

        $productos = array(); // Inicializamos un array para almacenar los productos

        if ($resultado = $con->query($sql)) {
            while ($producto = $resultado->fetch_object()) {
                $productos[] = $producto; // Agregamos cada producto al array
            }
            return $productos; // Devolvemos el array con todos los productos
        } else {
            return null; // Devolvemos null en caso de error en la consulta
        }
    }

    public static function getProductoPacks($categoria)
    {
        $con = DataBase::connect();
        $sql = "SELECT * FROM productos WHERE ID_CATEGORIA = 3";

        $productos = array(); // Inicializamos un array para almacenar los productos

        if ($resultado = $con->query($sql)) {
            while ($producto = $resultado->fetch_object()) {
                $productos[] = $producto; // Agregamos cada producto al array
            }
            return $productos; // Devolvemos el array con todos los productos
        } else {
            return null; // Devolvemos null en caso de error en la consulta
        }
    }

    public static function getAllProductoCarta()
    {
        $con = DataBase::connect();
        $sql = "SELECT ID_CATEGORIA, ID_PRODUCTO, IMG, PRECIO, NOMBRE_PRODUCTO, DESCRIPCION FROM productos";

        $productos = array();

        if ($result = $con->query($sql)) {
            while ($row = $result->fetch_object()) {
                $productos[] = $row;
            }
        }

        $con->close();

        return $productos;
    }

    public static function topVentas()
    {
        $con = DataBase::connect();

        // Consulta para obtener los IDs de los productos más pedidos
        $sql = "SELECT ID_PRODUCTO, SUM(CANTIDAD) AS total_pedidos
                FROM pedido_articulos
                GROUP BY ID_PRODUCTO
                ORDER BY total_pedidos DESC
                LIMIT 5"; // Puedes ajustar el límite según tus necesidades

        $mostOrderedProductIDs = array();

        if ($result = $con->query($sql)) {
            while ($row = $result->fetch_object()) {
                $mostOrderedProductIDs[] = $row->ID_PRODUCTO;
            }
        }

        // Consulta para obtener todos los datos de los productos más pedidos
        $productos = array();

        if (!empty($mostOrderedProductIDs)) {
            $inClause = implode(',', $mostOrderedProductIDs);
            $sqlProductos = "SELECT * FROM productos WHERE ID_PRODUCTO IN ($inClause)";

            if ($resultProductos = $con->query($sqlProductos)) {
                while ($rowProductos = $resultProductos->fetch_object()) {
                    $productos[] = $rowProductos;
                }
            }
        }

        $con->close();

        return $productos;
    }

    public static function actualizarProducto($idProducto, $nombreProducto, $descripcion, $precio, $cantidad, $img, $idCategoria)
    {
        $con = DataBase::connect();

        // Preparar la consulta con una sentencia preparada
        $sql = "UPDATE productos SET NOMBRE_PRODUCTO=?, DESCRIPCION=?, PRECIO=?, CANTIDAD=?, IMG=?, ID_CATEGORIA=? WHERE ID_PRODUCTO=?";
        $stmt = $con->prepare($sql);

        // Enlazar los valores a los marcadores de posición
        $stmt->bind_param("ssdsssd", $nombreProducto, $descripcion, $precio, $cantidad, $img, $idCategoria, $idProducto);

        // Ejecutar la consulta
        $stmt->execute();

        // Cerrar la conexión
        $stmt->close();
        $con->close();
    }

    public static function eliminarProducto($idProducto)
    {
        $con = DataBase::connect();

        // Preparar la consulta con una sentencia preparada
        $sql = "DELETE FROM productos WHERE ID_PRODUCTO=?";
        $stmt = $con->prepare($sql);

        // Enlazar el valor al marcador de posición
        $stmt->bind_param("s", $idProducto);

        // Ejecutar la consulta
        $stmt->execute();

        // Cerrar la conexión
        $stmt->close();
        $con->close();
    }

    public static function crearProducto($idCategoria, $nombreProducto, $descripcion, $precio, $cantidad, $img)
    {
        $con = DataBase::connect();

        // Preparar la consulta con una sentencia preparada
        $sql = "INSERT INTO productos (ID_CATEGORIA, NOMBRE_PRODUCTO, DESCRIPCION, PRECIO, CANTIDAD, IMG) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($sql);

        // Enlazar los valores a los marcadores de posición
        $stmt->bind_param("dssdsd", $idCategoria, $nombreProducto, $descripcion, $precio, $cantidad, $img);

        // Ejecutar la consulta
        $stmt->execute();

        // Cerrar la conexión
        $stmt->close();
        $con->close();
    }

    public static function getProductosByCategoria($categorias)
    {

        $con = DataBase::connect();

        // Validar que $categorias es un array y no está vacío
        if (!is_array($categorias) || empty($categorias)) {
            return null;
        }

        // Crear una cadena con los IDs de categorías para usar en la cláusula WHERE
        $categoriasString = implode(',', $categorias);

        // Modificar la consulta para seleccionar productos de las categorías especificadas
        $sql = "SELECT * FROM productos WHERE ID_CATEGORIA IN ($categoriasString)";

        $productos = array(); // Inicializamos un array para almacenar los productos

        if ($resultado = $con->query($sql)) {
            while ($producto = $resultado->fetch_object()) {
                $productos[] = $producto; // Agregamos cada producto al array
            }
            return $productos; // Devolvemos el array con todos los productos
        } else {
            return null; // Devolvemos null en caso de error en la consulta
        }
    }
}
?>