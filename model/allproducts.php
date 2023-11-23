<?php
include_once("config/db.php");

class allproducts
{
    public static function getAllProducto()
    {
        $con = DataBase::connect();
        $sql = "SELECT ID_PRODUCTO, IMG, PRECIO, NOMBRE_PRODUCTO, DESCRIPCION FROM productos";

        $productos = array();

        if ($result = $con->query($sql)) {
            while ($row = $result->fetch_assoc()) {
                $productos[] = $row;
            }
        }

        $con->close();

        return $productos;
    }
}
?>
