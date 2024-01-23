<?php

class APIController
{
    public function api()
    {
        include_once 'config/db.php';
        include_once 'model/resena.php';

        // Obtén los datos del formulario con FormData
        $accion = isset($_POST['accion']) ? $_POST['accion'] : 'default_value';

        if ($accion == 'get_reviews') {
            $resenas = Resena::obtenerTodasResenas();
            $array_resenas = [];
            foreach ($resenas as $resena) {
                $array_resenas[] = [
                    "ID_RESEÑA" => $resena->getIdResena(),
                    "ID_PEDIDO" => $resena->getIdPedido(),
                    "ASUNTO_RESEÑA" => $resena->getAsuntoResena(),
                    "COMENTARIO_RESEÑA" => $resena->getComentarioResena(),
                    "FECHA_RESEÑA" => $resena->getFechaResena(),
                    "VALORACION_RESEÑA" => $resena->getValoracionResena()
                ];
            }

            // Envia la respuesta como JSON
            echo json_encode($array_resenas, JSON_UNESCAPED_UNICODE);
        } else if ($accion == 'add_review') {
            // Modifica cómo obtienes los datos del formulario
            $id_resena = isset($_POST["id_resena"]) ? $_POST["id_resena"] : null;
            $id_pedido = isset($_POST["id_pedido"]) ? $_POST["id_pedido"] : null;
            $asunto_resena = isset($_POST["asunto_resena"]) ? $_POST["asunto_resena"] : null;
            $comentario_resena = isset($_POST["comentario_resena"]) ? $_POST["comentario_resena"] : null;
            $valoracion_resena = isset($_POST["valoracion_resena"]) ? $_POST["valoracion_resena"] : null;

            // Usa date() en lugar de NOW() para obtener la fecha actual
            $fecha_actual = date('Y-m-d H:i:s');

            $resena = new Resena($id_resena, $id_pedido, $asunto_resena, $comentario_resena, $fecha_actual, $valoracion_resena);

            $resena->addResena();

            // Enviar una respuesta JSON válida
            echo json_encode(["mensaje" => "Reseña añadida correctamente"], JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(["error" => "La clave 'accion' no está definida."], JSON_UNESCAPED_UNICODE);
            exit();
        }
    }
}
?>
