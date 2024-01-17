<?php

class APIController
{
    public function api()
    {
        include_once 'config/db.php';
        include_once 'model/reseñaDAO.php';

        if ($_POST["accion"] == 'buscar_pedido') {
            $id_usuario = json_decode($_POST["id_usuario"]);

            echo json_encode($pedidos, JSON_UNESCAPED_UNICODE);
            return;
            
        } else if ($_POST["accion"] == 'add_review') {
            $id_pedido = json_decode($_POST["id_pedido"]);
            $id_usuario = json_decode($_POST["id_usuario"]);
            $asunto_resena = json_decode($_POST["asunto_resena"]);
            $comentario_resena = json_decode($_POST["comentario_resena"]);
            $valoracion_resena = json_decode($_POST["valoracion_resena"]);

            // Realiza la lógica para insertar la reseña en la base de datos utilizando el MODELO
            $resena = new Resena($id_pedido, $id_usuario, $asunto_resena, $comentario_resena, date("Y-m-d H:i:s"), $valoracion_resena);

            // Llama al método de instancia en lugar de tratar de llamarlo estáticamente
            $resena->addResena();

            // Puedes devolver un mensaje o información adicional si es necesario
            echo json_encode(["mensaje" => "Reseña añadida correctamente"], JSON_UNESCAPED_UNICODE);
            return;
        }
    }
}
?>