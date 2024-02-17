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
            $resenas = Resena::obtenerTodasResenasConEmail(); // Obtener reseñas con email de usuario
            $array_resenas = [];
            foreach ($resenas as $resena) {
                $array_resenas[] = [
                    "ID_RESEÑA" => $resena->getIdResena(),
                    "ID_PEDIDO" => $resena->getIdPedido(),
                    "ASUNTO_RESEÑA" => $resena->getAsuntoResena(),
                    "COMENTARIO_RESEÑA" => $resena->getComentarioResena(),
                    "FECHA_RESEÑA" => $resena->getFechaResena(),
                    "VALORACION_RESEÑA" => $resena->getValoracionResena(),
                    "EMAIL_USUARIO" => $resena->getEmailUsuario() // Agregar email de usuario
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
        
            // Verifica si ya existe una reseña para el pedido
            if (Resena::pedidoTieneResena($id_pedido)) {
                // Ya existe una reseña para este pedido, devuelve un mensaje de error
                echo json_encode(["error" => "Ya existe una reseña para este pedido"], JSON_UNESCAPED_UNICODE);
            } else {
                // No existe una reseña para este pedido, añade la nueva reseña
                $resena = new Resena($id_resena, $id_pedido, $asunto_resena, $comentario_resena, $fecha_actual, $valoracion_resena);
                $resena->addResena();
        
                // Enviar una respuesta JSON válida
                echo json_encode(["mensaje" => "Reseña añadida correctamente"], JSON_UNESCAPED_UNICODE);
            }
        

        } else if ($accion == 'get_products') {
            include_once('model\productoDAO.php');
            // Obtener productos desde la base de datos
            $productos = productoDAO::getAllProductoCarta();
            $array_productos = [];
            foreach ($productos as $producto) {
                $array_productos[] = [
                    "ID_CATEGORIA" => $producto->ID_CATEGORIA,
                    "ID_PRODUCTO" => $producto->ID_PRODUCTO,
                    "NOMBRE_PRODUCTO" => $producto->NOMBRE_PRODUCTO,
                    "DESCRIPCION" => $producto->DESCRIPCION,
                    "PRECIO" => $producto->PRECIO,
                    "IMG" => $producto->IMG
                    // Puedes incluir más atributos según sea necesario
                ];
            }
            // Envia la respuesta como JSON
            echo json_encode($array_productos, JSON_UNESCAPED_UNICODE);

        } else if ($accion == 'add_points_to_user') {
            // Obtener el precio total del carrito desde el formulario
            $precio_total_carrito = isset($_POST["precio_total_carrito"]) ? $_POST["precio_total_carrito"] : null;

            // Calcular la cantidad de puntos a agregar
            $puntos_a_agregar = $precio_total_carrito * 100;

            // Aquí necesitarías obtener el ID del usuario que está haciendo el pedido
            $id_usuario = usuarioController::obtenerIdUsuario(); // Obtener el ID del usuario actual desde la sesión o algún otro método

            if ($id_usuario) {
                // Actualizar el puntaje de puntos del usuario en la tabla de usuarios
                $conexion = Database::connect();
                $sql = "UPDATE usuarios SET puntos = puntos + ? WHERE ID_USUARIO = ?";
                $consulta = $conexion->prepare($sql);
                $consulta->bind_param("ii", $puntos_a_agregar, $id_usuario);
                $consulta->execute();
                $num_filas_afectadas = $conexion->affected_rows;


                // Verificar si la consulta se ejecutó correctamente
                if ($num_filas_afectadas > 0) {
                    // Devolver respuesta en formato JSON
                    echo json_encode(["mensaje" => "Puntos agregados correctamente"]);
                } else {
                    // Devolver respuesta en formato JSON
                    echo json_encode(["error" => "Error al agregar puntos"]);
                }
            } else {
                // Devolver respuesta en formato JSON
                echo json_encode(["error" => "No se pudo obtener el ID del usuario"]);
            }


        } else if ($accion == 'subtract_points_from_user') {
            // Obtener la cantidad de puntos a utilizar desde el formulario
            $puntos_utilizados = isset($_POST["cantidadPuntos"]) ? $_POST["cantidadPuntos"] : null;
        
            // Aquí necesitarías obtener el ID del usuario que está haciendo el pedido
            $id_usuario = usuarioController::obtenerIdUsuario(); // Obtener el ID del usuario actual desde la sesión o algún otro método
        
            if ($id_usuario) {
                // Restar los puntos utilizados del puntaje de puntos del usuario en la tabla de usuarios
                $conexion = Database::connect();
                $sql = "UPDATE usuarios SET puntos = puntos - ? WHERE ID_USUARIO = ?";
                $consulta = $conexion->prepare($sql);
                $consulta->bind_param("ii", $puntos_utilizados, $id_usuario);
                $consulta->execute();
                $num_filas_afectadas = $conexion->affected_rows;
        
                // Verificar si la consulta se ejecutó correctamente
                if ($num_filas_afectadas > 0) {
                    // Devolver respuesta en formato JSON
                    echo json_encode(["mensaje" => "Puntos restados correctamente"]);
                } else {
                    // Devolver respuesta en formato JSON
                    echo json_encode(["error" => "Error al restar puntos"]);
                }
            } else {
                // Devolver respuesta en formato JSON
                echo json_encode(["error" => "No se pudo obtener el ID del usuario"]);
            }
                
        } else {
            echo json_encode(["error" => "La clave 'accion' no está definida."], JSON_UNESCAPED_UNICODE);
            exit();
        }
    }
}
?>