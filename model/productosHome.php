<?php
include_once("config/db.php");

class productoHome
{
    public static function getAllProducto()
    {
        $con = DataBase::connect();
        $sql = "SELECT IMG, PRECIO, NOMBRE_PRODUCTO FROM productos";

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
