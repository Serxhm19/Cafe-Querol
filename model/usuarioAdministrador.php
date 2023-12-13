<?php
class UsuarioAdministrador extends Usuario {
    public function __construct(
        $idUsuario,
        $nombre,
        $apellido,
        $contrasena,
        $correo,
        $telefono,
        $direccion
    ) {
        parent::__construct($idUsuario, $nombre, $apellido, $contrasena, $correo, $telefono, $direccion, 'admin');
    }

    // Otros métodos específicos para administradores...
}
?>