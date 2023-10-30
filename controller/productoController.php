<?php

//Creamos el controlador de pedidos
include_once 'views/cabecera.php';
include_once 'model/productoDAO.php';

class productoController{

    public function index(){
       include_once "views/cabecera.php";
       $allProducts = productoDAO::getAllProducto();

        
    }
    

    public function compra(){
        echo 'pagina de compra';
    }


}

?>