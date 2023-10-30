<?php

class DataBase{
    public static function connect($host = 'localhost', $user = 'root', $password = '', $database = 'cafequerol'){
        $con = new mysqli($host, $user, $password, $database);
        if ($con == false) {
            die("Connection failed: ");
        }else{
            return $con;
        }
    }
}
 ?>