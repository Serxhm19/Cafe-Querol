<?php

class resena
{
    protected $idResena;
    protected $idPedido;
    protected $asuntoResena;
    protected $comentarioResena;
    protected $fechaResena;
    protected $valoracionResena;

    // Constructor para crear una instancia de Resena
    public function __construct($idResena, $idPedido, $asuntoResena, $comentarioResena, $fechaResena, $valoracionResena)
    {
        $this->idResena = $idResena;
        $this->idPedido = $idPedido;
        $this->asuntoResena = $asuntoResena;
        $this->comentarioResena = $comentarioResena;
        $this->fechaResena = $fechaResena;
        $this->valoracionResena = $valoracionResena;
    }

    // Métodos para acceder a los datos de la reseña


    /**
     * Get the value of idResena
     */
    public function getIdResena()
    {
        return $this->idResena;
    }

    /**
     * Set the value of idResena
     *
     * @return  self
     */
    public function setIdResena($idResena)
    {
        $this->idResena = $idResena;

        return $this;
    }

    /**
     * Get the value of idPedido
     */
    public function getIdPedido()
    {
        return $this->idPedido;
    }

    /**
     * Set the value of idPedido
     *
     * @return  self
     */
    public function setIdPedido($idPedido)
    {
        $this->idPedido = $idPedido;

        return $this;
    }

    /**
     * Get the value of asuntoResena
     */
    public function getAsuntoResena()
    {
        return $this->asuntoResena;
    }

    /**
     * Set the value of asuntoResena
     *
     * @return  self
     */
    public function setAsuntoResena($asuntoResena)
    {
        $this->asuntoResena = $asuntoResena;

        return $this;
    }

    /**
     * Get the value of comentarioResena
     */
    public function getComentarioResena()
    {
        return $this->comentarioResena;
    }

    /**
     * Set the value of comentarioResena
     *
     * @return  self
     */
    public function setComentarioResena($comentarioResena)
    {
        $this->comentarioResena = $comentarioResena;

        return $this;
    }

    /**
     * Get the value of fechaResena
     */
    public function getFechaResena()
    {
        return $this->fechaResena;
    }

    /**
     * Set the value of fechaResena
     *
     * @return  self
     */
    public function setFechaResena($fechaResena)
    {
        $this->fechaResena = $fechaResena;

        return $this;
    }

    /**
     * Get the value of valoracionResena
     */
    public function getValoracionResena()
    {
        return $this->valoracionResena;
    }

    /**
     * Set the value of valoracionResena
     *
     * @return  self
     */
    public function setValoracionResena($valoracionResena)
    {
        $this->valoracionResena = $valoracionResena;

        return $this;
    }

    public function addResena()
    {
        // Obtén la conexión a la base de datos utilizando tu método o clase de conexión
        $con = DataBase::connect();

        // Verificar si ya existe una reseña para el pedido
        $resenaExistente = self::obtenerResenaPorPedido($this->idPedido);

        // Arreglo asociativo para almacenar el resultado y los mensajes
        $response = array();

        if ($resenaExistente) {
            $response['exists'] = true;
            $response['error'] = 'Ya existe una reseña para este pedido.';
        } else {
            // Preparar la consulta con una sentencia preparada
            $sql = "INSERT INTO reseñas (ID_PEDIDO, ASUNTO_RESEÑA, COMENTARIO_RESEÑA, FECHA_RESEÑA, VALORACION_RESEÑA) VALUES (?, ?, ?, NOW(), ?)";
            $stmt = $con->prepare($sql);

            // Verifica si la preparación de la consulta fue exitosa
            if ($stmt) {
                // Enlazar los valores a los marcadores de posición
                $stmt->bind_param("dssd", $this->idPedido, $this->asuntoResena, $this->comentarioResena, $this->valoracionResena);

                // Ejecutar la consulta
                if ($stmt->execute()) {
                    $response['success'] = 'Reseña añadida con éxito';
                } else {
                    $response['error'] = 'Error al añadir la reseña: ' . $stmt->error;
                }

                // Cerrar la sentencia preparada
                $stmt->close();
            } else {
                $response['error'] = 'Error en la preparación de la consulta';
            }
        }

        // Cerrar la conexión
        $con->close();

        // Imprimir el resultado como JSON
        echo json_encode($response);
    }



    public static function obtenerResenaPorPedido($idPedido)
    {
        $con = DataBase::connect();

        $sql = "SELECT * FROM reseñas WHERE ID_PEDIDO = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("s", $idPedido);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result) {
            if ($row = $result->fetch_assoc()) {
                $resena = new Resena(
                    $row['ID_RESEÑA'],
                    $row['ID_PEDIDO'],
                    $row['ASUNTO_RESEÑA'],
                    $row['COMENTARIO_RESEÑA'],
                    $row['FECHA_RESEÑA'],
                    $row['VALORACION_RESEÑA']
                );

                return $resena;
            }
        } else {
            echo "Error al obtener la reseña: " . $con->error;
        }
        return null;
    }



    public static function obtenerTodasResenas()
    {
        $con = DataBase::connect();
        $sql = "SELECT * FROM reseñas";
        $result = $con->query($sql);

        if ($result) {
            $resenas = [];

            while ($row = $result->fetch_assoc()) {
                $resena = new Resena(
                    $row['ID_RESEÑA'],
                    $row['ID_PEDIDO'],
                    $row['ASUNTO_RESEÑA'],
                    $row['COMENTARIO_RESEÑA'],
                    $row['FECHA_RESEÑA'],
                    $row['VALORACION_RESEÑA']
                );
                $resenas[] = $resena;
            }

            $con->close();
            return $resenas;
        } else {
            echo "Error al obtener las reseñas: " . $con->error;
        }

        $con->close();
        return [];
    }


    public static function obtenerResenaPorId($idResena)
    {
        $con = DataBase::connect();

        $sql = "SELECT * FROM reseñas WHERE ID_RESEÑA = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("s", $idResena);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result) {
            if ($row = $result->fetch_assoc()) {
                $resena = new Resena(
                    $row['ID_RESEÑA'],
                    $row['ID_PEDIDO'],
                    $row['ASUNTO_RESEÑA'],
                    $row['COMENTARIO_RESEÑA'],
                    $row['FECHA_RESEÑA'],
                    $row['VALORACION_RESEÑA']
                );

                return $resena;
            } else {
                echo "No se encontró ninguna reseña con el ID proporcionado.";
            }
        } else {
            echo "Error al obtener la reseña: " . $con->error;
        }
        return null;
    }




}

?>