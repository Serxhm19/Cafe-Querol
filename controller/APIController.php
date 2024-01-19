<?php

class APIController
{
    public function api()
    {
        include_once 'config/db.php';
        include_once 'model/resena.php';

        $accion = isset($_REQUEST['accion']) ? $_REQUEST['accion'] : '';

        echo $accion."1";

        if ($accion == 'get_reviews') {
            echo $accion."2";

            $resenas = Resena::obtenerTodasResenas();

            echo $accion."3";

            echo json_encode($resenas, JSON_UNESCAPED_UNICODE);
            return;

        } else if ($accion == 'add_review') {

            $id_pedido = $_POST["id_pedido"];
            $id_usuario = $_POST["id_usuario"];
            $asunto_resena = $_POST["asunto_resena"];
            $comentario_resena = $_POST["comentario_resena"];
            $valoracion_resena = $_POST["valoracion_resena"];

            $resena = new Resena(null, $id_pedido, $asunto_resena, $comentario_resena, NOW(), $valoracion_resena);

            $resena->addResena();

            echo json_encode(["mensaje" => "Reseña añadida correctamente"], JSON_UNESCAPED_UNICODE);
            return;
        } else {
            echo "Error: La clave 'accion' no está definida.";
            exit();
        }
    }
}
?>