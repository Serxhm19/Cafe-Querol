<?php

class APIController
{
    public function api()
    {
        include_once 'config/db.php';
        include_once 'model/resena.php';

        $accion = isset($_REQUEST['accion']) ? $_REQUEST['accion'] : '';

        if ($accion == 'get_reviews') {
            // Obtener todas las reseñas
            $resenas = Resena::obtenerTodasResenas();

            // Devolver las reseñas en formato JSON
            echo json_encode($resenas, JSON_UNESCAPED_UNICODE);
            return;
        } else if ($accion == 'add_review') {
            // Utiliza $_POST para obtener datos del cuerpo de la solicitud
            $id_pedido = $_POST["id_pedido"];
            $id_usuario = $_POST["id_usuario"];
            $asunto_resena = $_POST["asunto_resena"];
            $comentario_resena = $_POST["comentario_resena"];
            $valoracion_resena = $_POST["valoracion_resena"];

            // Crea una instancia de la clase Resena con los valores directamente
            $resena = new Resena(null, $id_pedido, $asunto_resena, $comentario_resena, date("Y-m-d H:i:s"), $valoracion_resena);

            // Llama al método de instancia en lugar de tratar de llamarlo estáticamente
            $resena->addResena();

            // Puedes devolver un mensaje o información adicional si es necesario
            echo json_encode(["mensaje" => "Reseña añadida correctamente"], JSON_UNESCAPED_UNICODE);
            return;
        } else {
            echo "Error: La clave 'accion' no está definida.";
            exit();
        }
    }
}
?>