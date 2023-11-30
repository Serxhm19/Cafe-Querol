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
        $sql = "SELECT * FROM productos WHERE id = ?";

        if ($resultado = $con->query($sql)) {

            while ($idproducto = $resultado->fetch_object()) {
                return $idproducto;
            }
            return $idproducto;
        }
    }

    public static function getProductoBebidas($categoria)
    {
        $con = DataBase::connect();
        $sql = "SELECT * FROM productos WHERE ID_CATEGORIA = 1";
    
        $productos = array(); // Inicializamos un array para almacenar los productos
    
        if ($resultado = $con->query($sql)) {
            while ($producto = $resultado->fetch_array()) {
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
            while ($producto = $resultado->fetch_array()) {
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
            while ($producto = $resultado->fetch_array()) {
                $productos[] = $producto; // Agregamos cada producto al array
            }
            return $productos; // Devolvemos el array con todos los productos
        } else {
            return null; // Devolvemos null en caso de error en la consulta
        }
    }
    

}








?>