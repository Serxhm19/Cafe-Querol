<?php
class Usuario
{
    protected $idUsuario;
    protected $nombre;
    protected $apellido;
    protected $contrasena;
    protected $correo;
    protected $telefono;
    protected $direccion;
    protected $permiso;

    // Constructor
    public function __construct(
        $nombre,
        $apellido,
        $contrasena,
        $correo,
        $telefono,
        $direccion,
        $permiso
    ) {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->hashContrasena = password_hash($contrasena, PASSWORD_DEFAULT);
        $this->correo = $correo;
        $this->telefono = $telefono;
        $this->direccion = $direccion;
        $this->permiso = $permiso;
    }




    /**
     * Get the value of idUsuario
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * Set the value of idUsuario
     *
     * @return  self
     */
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }

    /**
     * Get the value of nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of apellido
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Set the value of apellido
     *
     * @return  self
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get the value of contrasena
     */
    public function getContrasena()
    {
        return $this->contrasena;
    }

    /**
     * Set the value of contrasena
     *
     * @return  self
     */
    public function setContrasena($contrasena)
    {
        $this->contrasena = $contrasena;

        return $this;
    }

    /**
     * Get the value of correo
     */
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * Set the value of correo
     *
     * @return  self
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;

        return $this;
    }

    /**
     * Get the value of telefono
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set the value of telefono
     *
     * @return  self
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get the value of direccion
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set the value of direccion
     *
     * @return  self
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get the value of permiso
     */
    public function getPermiso()
    {
        return $this->permiso;
    }

    /**
     * Set the value of permiso
     *
     * @return  self
     */
    public function setPermiso($permiso)
    {
        $this->permiso = $permiso;

        return $this;
    }

    function obtenerDatosClienteReseñas()
    {
        // Verificar si el correo electrónico está almacenado en el localStorage
        if (isset($_COOKIE['email'])) {
            // Obtener el correo electrónico del localStorage
            $email = $_COOKIE['email'];

            // Conexión a la base de datos (asumiendo que tienes una conexión establecida)
            $con = DataBase::connect();

            // Verificar la conexión
            if ($con->connect_error) {
                die("Conexión fallida: " . $con->connect_error);
            }

            // Consulta SQL para obtener el id_usuario correspondiente al correo electrónico
            $sql = "SELECT id_usuario FROM usuarios WHERE correo = '$email'";

            // Ejecutar la consulta
            $resultado = $con->query($sql);

            // Verificar si se encontró el usuario
            if ($resultado->num_rows > 0) {
                // Obtener el resultado de la consulta
                $fila = $resultado->fetch_assoc();
                // Obtener el id_usuario
                $id_usuario = $fila['id_usuario'];

                // Cerrar la conexión
                $con->close();

                // Devolver el id_usuario
                return $id_usuario;
            } else {
                // Cerrar la conexión
                $con->close();

                // Si no se encuentra el usuario, devolver un valor por defecto
                return 0;
            }
        } else {
            // Si no se encuentra el correo electrónico en el localStorage, devolver un valor por defecto
            return 0;
        }
    }


}


?>