
<?php
include ("usuario.php");
class UsuarioEstandar extends Usuario {
    public function __construct(
        $nombre,
        $apellido,
        $contrasena,
        $correo,
        $telefono,
        $direccion
    ) {
        parent::__construct($nombre, $apellido, $contrasena, $correo, $telefono, $direccion, 'estandar');
    }

    // Otros métodos específicos para usuarios estándar...
}

?>