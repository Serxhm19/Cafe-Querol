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

    public static function getProductoById($id){
        
        $con = DataBase::connect();
        $sql = "SELECT * FROM productos WHERE id = '$id'";

        if ($resultado = $con->query($sql)) {

            while ($idproducto = $resultado->fetch_object()) {
                return $idproducto;
            }
            return $idproducto;
        }
    }


}










?>