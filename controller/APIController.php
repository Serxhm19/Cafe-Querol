<?php

// IMPORTANTE: Asegúrate de incluir los modelos necesarios de tu base de datos

class APIController
{
    public function api()
    {
        if ($_POST["accion"] == 'buscar_pedido') {
            // Decodificamos los datos JSON que se reciben desde JS
            $id_usuario = json_decode($_POST["id_usuario"]);

            // Aquí debes realizar la lógica para buscar pedidos en la base de datos
            include_once 'config/parametros.php';
            $conn = DataBase::connect();

            // Verificar si el email del usuario está almacenado en la sesión
            if (isset($_SESSION['email'])) {
                $email = $_SESSION['email'];

                // Consulta SQL para obtener el ID del usuario utilizando el email
                $idUsuarioQuery = "SELECT ID_USUARIO FROM usuarios WHERE CORREO = '$email'";
                $resultIdUsuario = $conn->query($idUsuarioQuery);

                if ($resultIdUsuario->num_rows > 0) {
                    // Obtener el ID de usuario de la consulta
                    $row = $resultIdUsuario->fetch_assoc();
                    $idUsuario = $row['ID_USUARIO'];

                    // Consulta SQL para obtener los pedidos del usuario
                    $pedidoQuery = "SELECT * FROM pedidos WHERE ID_USUARIO = $idUsuario";
                    $resultPedidos = $conn->query($pedidoQuery);

                    $pedidos = array();

                    // Verificar si hay pedidos
                    if ($resultPedidos->num_rows > 0) {
                        // Obtener los pedidos y agregarlos al array
                        while ($pedido = $resultPedidos->fetch_assoc()) {
                            $pedidos[] = $pedido;
                        }
                    } else {
                        // No hay pedidos
                        $pedidos = "No hay pedidos para este usuario.";
                    }
                } else {
                    // No se encontró el ID de usuario
                    $pedidos = "No se encontró el ID de usuario.";
                }
            } else {
                // La sesión de correo no está definida
                $pedidos = "La sesión de correo no está definida.";
            }

            // Devolvemos la información al JS codificada en JSON
            echo json_encode($pedidos, JSON_UNESCAPED_UNICODE);
            return;

        } else if ($_POST["accion"] == 'add_review') {
            // Decodificamos los datos JSON que se reciben desde JS
            $id_pedido = json_decode($_POST["id_pedido"]);
            $id_usuario = json_decode($_POST["id_usuario"]);

            // Aquí debes realizar la lógica para agregar una reseña a la base de datos
            // Puedes utilizar el modelo correspondiente para interactuar con la base de datos
            // Ejemplo: ResenaModel::agregarResena($id_pedido, $id_usuario, $otrosDatos);

            // XXXXXXXXXXXX: Reemplaza la siguiente línea con la lógica específica de tu aplicación
            echo "Bienvenido Pedrito";

            return;
        }
    }
}
?>