<?php



class usuarioController
{

    public function login()
    {
        include_once "views/login.php";
    }

    public function Register()
    {
        include_once "views/Register.php";
    }

    public function dashboard()
    {
        include_once "views/dashboardUser.php";
    }


    public function admin()
    {
        include_once "views/admin.php";
    }

    public function mispedidos()
    {
        include_once "views/pedidos.php";
    }

    public function adminPage()
    {
        include_once "views/adminPage.php";
    }


    public function verificarCorreo()
    {
        include_once 'config/parametros.php';
        include_once 'config/db.php';
        session_start();

        // Suponiendo que tu clase de conexión a la base de datos se llama DataBase y tienes un método connect()
        $con = DataBase::connect();

        // Verifica si se ha enviado el formulario
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Suponiendo que $_POST["email"] contiene el correo electrónico a verificar
            $inputEmail = $_POST["email"];

            // Verifica si hay al menos un símbolo '@' en el correo electrónico
            if (!strpos($inputEmail, '@')) {
                $_SESSION['errorMessage'] = "El correo electrónico debe contener al menos un símbolo '@'.";
                header("Location: " . $url . "?controller=usuario&action=login");
                exit();
            }

            // Consulta para verificar si el correo está en la tabla usuarios
            $sql = "SELECT ID_USUARIO FROM usuarios WHERE CORREO = ?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param('s', $inputEmail);
            $stmt->execute();

            // Después de verificar el correo en el controlador
            $stmt->store_result();  // Almacena el resultado para poder usar $stmt->num_rows
            if ($stmt->num_rows > 0) {
                $_SESSION['errorMessage'] = "Una cuenta ya está registrada con este e-mail, por favor introduce la contraseña.";
                header("Location: " . $url . "?controller=usuario&action=login");
            } else {
                // No hay error, redirigir a la página de registro
                header("Location: " . $url . "?controller=usuario&action=Register");
                exit();
            }

        }
    }
    public function Logged()
    {
        session_start();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            include_once 'config/db.php';

            $con = DataBase::connect();

            $inputEmail = $_POST["email"];
            $inputPassword = $_POST["password"];

            // Consulta para verificar las credenciales del usuario
            $sql = "SELECT CORREO, PASSWORD, PERMISO FROM usuarios WHERE CORREO = ?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param('s', $inputEmail);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $stmt->bind_result($email, $hashed_password, $userPermission);
                $stmt->fetch();

                // Verifica la contraseña utilizando password_verify
                if (password_verify($inputPassword, $hashed_password)) {
                    // Inicio de sesión exitoso
                    $_SESSION['email'] = $email;

                    if ($userPermission == 0) {
                        header("Location: ?controller=usuario&action=dashboard"); // Redirige al panel de administración
                    } else {
                        header("Location: ?controller=usuario&action=dashboard"); // Redirige al panel de usuario normal
                    }

                    exit();
                } else {
                    $_SESSION['errorMessage'] = "Contraseña incorrecta. Intenta nuevamente.";
                }
            } else {
                $_SESSION['errorMessage'] = "No se encontró ninguna cuenta asociada a este correo electrónico.";
            }

            header("Location: ?controller=usuario&action=login"); // Redirige de nuevo a la página de inicio de sesión con el mensaje de error
            exit();
        }
    }


    public function RegistrarUsuario()
    {
        include_once 'model/usuarioEstandar.php'; // Ajusta la ruta según tu estructura de archivos
        include_once 'config/db.php'; // Ajusta la ruta según tu estructura de archivos

        // Verificar si se ha enviado el formulario
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Obtener los datos del formulario
            $nombre = $_POST["nombre"];
            $apellido = $_POST["apellido"];
            $contrasena = $_POST["contrasena"];
            $hashed_password = password_hash($contrasena, PASSWORD_DEFAULT);
            $correo = $_POST["correo"];
            $telefono = $_POST["telefono"];
            $direccion = $_POST["direccion"];

            // Crear una instancia de usuarioEstandar y establecer los datos
            $usuario = new UsuarioEstandar($nombre, $apellido, $hashed_password, $correo, $telefono, $direccion);

            // Guardar el usuario en la base de datos
            $con = DataBase::connect(); // Ajusta según tu clase de conexión

            $sql = "INSERT INTO usuarios (NOMBRE, APELLIDO, PASSWORD, CORREO, TELEFONO, DIRECCION, PERMISO) 
                    VALUES (?, ?, ?, ?, ?, ?, 1)";

            $stmt = $con->prepare($sql);

            // Bind de parámetros
            $stmt->bind_param('ssssss', $nombre, $apellido, $hashed_password, $correo, $telefono, $direccion);

            if ($stmt->execute()) {
                header("Location: ?controller=usuario&action=login"); // Redirige de nuevo a la página de inicio de sesión con el mensaje de error
                exit(); // Agrega esta línea para evitar ejecución adicional del código
            } else {
                echo "Error al registrar el usuario.";
            }

            $stmt->close(); // Cierra la declaración preparada
            $con->close();  // Cierra la conexión a la base de datos
        }
    }


    public function CerrarSesion()
    {
        session_start(); // Inicia la sesión si no se ha iniciado aún

        // Elimina todas las variables de sesión
        $_SESSION = array();

        // Borra la cookie de sesión, si está definida
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 42000, '/');
        }

        // Finaliza la sesión
        session_destroy();

        // Redirige a la página de inicio de sesión u otra página que desees
        header("Location: ?controller=usuario&action=login");
        exit();
    }


    public function ActualizarDatos()
    {
        session_start();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            include_once 'config/db.php';

            $con = DataBase::connect();

            $inputPassword = $_POST["passwd"];
            $newEmail = $_POST["email"];
            $confirmEmail = $_POST["email2"];

            // Consulta para verificar las credenciales del usuario
            $sql = "SELECT ID_USUARIO, PASSWORD FROM usuarios WHERE CORREO = ?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param('s', $_SESSION['email']);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $stmt->bind_result($userId, $storedPassword);
                $stmt->fetch();

                // Verifica la contraseña
                if ($inputPassword == $storedPassword) {
                    // Contraseña correcta, procede a actualizar el correo electrónico
                    if ($newEmail == $_SESSION['email']) {
                        // Actualiza el correo electrónico en la base de datos solo si es diferente
                        $sqlUpdateEmail = "UPDATE usuarios SET CORREO = ? WHERE ID_USUARIO = ?";
                        $stmtUpdateEmail = $con->prepare($sqlUpdateEmail);
                        $stmtUpdateEmail->bind_param('si', $newEmail, $userId);

                        // Verifica si la preparación de la consulta fue exitosa
                        if ($stmtUpdateEmail) {
                            if ($stmtUpdateEmail->execute()) {
                                // Actualización exitosa
                                $_SESSION['email'] = $newEmail; // Actualiza la dirección de correo en la sesión
                                $_SESSION['successMessage'] = "Correo electrónico actualizado con éxito.";
                                header("Location: ?controller=usuario&action=dashboard");
                                exit();
                            } else {
                                $_SESSION['errorMessage'] = "Error al actualizar el correo electrónico.";
                            }

                            // Cierra la declaración preparada
                            $stmtUpdateEmail->close();
                        }

                        // Cierra la declaración preparada principal
                        $stmt->close();
                    } else {
                        $_SESSION['errorMessage'] = "No se encontró ninguna cuenta asociada a este correo electrónico.";
                    }

                    // Cierra la conexión a la base de datos
                    $con->close();
                    header("Location: ?controller=usuario&action=dashboard");
                    exit();
                }
            }
        }
    }

    public function ActualizarContrasena()
    {
        session_start();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            include_once 'config/db.php';

            $con = DataBase::connect();

            $inputPassword = $_POST["passwd"];
            $newPassword = $_POST["passwordnew"];
            $confirmPassword = $_POST["passwordnew2"];

            // Consulta para verificar las credenciales del usuario
            $sql = "SELECT ID_USUARIO, PASSWORD FROM usuarios WHERE CORREO = ?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param('s', $_SESSION['email']);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $stmt->bind_result($userId, $storedPassword);
                $stmt->fetch();

                // Verifica la contraseña usando password_verify
                if (password_verify($inputPassword, $storedPassword)) {
                    // Contraseña correcta, procede a actualizar la contraseña
                    if ($newPassword == $confirmPassword) {
                        // Actualiza la contraseña en la base de datos solo si las nuevas contraseñas coinciden
                        $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                        $sqlUpdatePassword = "UPDATE usuarios SET PASSWORD = ? WHERE ID_USUARIO = ?";
                        $stmtUpdatePassword = $con->prepare($sqlUpdatePassword);
                        $stmtUpdatePassword->bind_param('si', $hashedNewPassword, $userId);

                        // Verifica si la preparación de la consulta fue exitosa
                        if ($stmtUpdatePassword->execute()) {
                            // Actualización exitosa
                            $_SESSION['successMessage'] = "Contraseña actualizada con éxito.";
                            $stmtUpdatePassword->close();
                            $stmt->close();
                            $con->close();
                            header("Location: ?controller=usuario&action=dashboard");
                            exit();
                        } else {
                            $_SESSION['errorMessage'] = "Error al actualizar la contraseña.";
                        }
                    } else {
                        $_SESSION['errorMessage'] = "Las nuevas contraseñas no coinciden.";
                    }
                } else {
                    $_SESSION['errorMessage'] = "Contraseña incorrecta.";
                }
            } else {
                $_SESSION['errorMessage'] = "No se encontró ninguna cuenta asociada a este correo electrónico.";
            }

            // Cierra la conexión a la base de datos
            $stmt->close();
            $con->close();
            header("Location: ?controller=usuario&action=dashboard");
            exit();
        }
    }


    public function redirectToPage()
    {
        session_start();

        // Verifica si hay una sesión iniciada
        if (isset($_SESSION['email'])) {
            // Si hay una sesión iniciada, redirige a la página de dashboard
            header("Location: ?controller=usuario&action=dashboard");
            exit();
        } else {
            // Si no hay una sesión iniciada, redirige a la página de inicio de sesión
            header("Location: ?controller=usuario&action=login");
            exit();
        }
    }

    public static function obtenerDatosCliente()
    {
        // Verifica si hay una sesión iniciada
        if (isset($_SESSION['email'])) {
            // Datos de conexión a la base de datos
            include_once 'config/db.php';

            // Conecta a la base de datos
            $con = DataBase::connect();

            // Consulta para obtener los datos del cliente
            $sql = "SELECT NOMBRE, APELLIDO, CORREO, TELEFONO, DIRECCION FROM usuarios WHERE CORREO = ?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param('s', $_SESSION['email']);
            $stmt->execute();

            // Obtiene los resultados
            $result = $stmt->get_result();

            // Verifica si se encontraron resultados
            if ($result->num_rows > 0) {
                // Obtiene los datos del cliente y los guarda en un objeto
                return $result->fetch_object();
            }
        }

        // Si no hay resultados o no hay una sesión iniciada, devuelve null
        return null;
    }

    public static function obtenerDatosClienteReseñas()
    {
        // Verifica si hay una sesión iniciada
        if (isset($_SESSION['email'])) {
            // Datos de conexión a la base de datos
            include_once 'config/db.php';

            // Conecta a la base de datos
            $con = DataBase::connect();

            // Consulta para obtener los datos del cliente
            $sql = "SELECT ID_USUARIO, NOMBRE, APELLIDO FROM usuarios WHERE CORREO = ?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param('s', $_SESSION['email']);
            $stmt->execute();

            // Obtiene los resultados
            $result = $stmt->get_result();

            // Verifica si se encontraron resultados
            if ($result->num_rows > 0) {
                // Obtiene los datos del cliente y los guarda en un objeto
                return $result->fetch_object();
            }
        }

        // Si no hay resultados o no hay una sesión iniciada, devuelve null
        return null;
    }


    public static function obtenerPedidosUsuario()
    {
        include_once 'config/db.php';

        // Verificar si la sesión está iniciada
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Verificar si el email del usuario está almacenado en la sesión
        if (isset($_SESSION['email'])) {
            $email = $_SESSION['email'];

            // Establecer la conexión a la base de datos (reemplaza los valores con los tuyos)
            $con = DataBase::connect();

            // Verificar la conexión
            if ($con->connect_error) {
                die("Conexión fallida: " . $con->connect_error);
            }

            // Consulta SQL para obtener el ID del usuario utilizando el email
            $idUsuarioQuery = "SELECT ID_USUARIO FROM usuarios WHERE CORREO = '$email'";
            $resultIdUsuario = $con->query($idUsuarioQuery);

            // Verificar si hay resultados
            if ($resultIdUsuario->num_rows > 0) {
                // Obtener el ID del usuario
                $rowIdUsuario = $resultIdUsuario->fetch_assoc();
                $idUsuario = $rowIdUsuario['ID_USUARIO'];

                // Consulta SQL para obtener los datos de los pedidos para el usuario específico
                $sql = "SELECT ID_PEDIDO, ESTADO, FECHA_PEDIDO FROM pedidos WHERE ID_USUARIO = $idUsuario";

                // Ejecutar la consulta
                $result = $con->query($sql);

                // Verificar si hay resultados
                if ($result->num_rows > 0) {
                    // Crear un array para almacenar los resultados
                    $pedidos = array();

                    // Recorrer los resultados y agregarlos al array
                    while ($row = $result->fetch_assoc()) {
                        $pedidos[] = $row;
                    }

                    // Cerrar la conexión y devolver el array de pedidos
                    $con->close();
                    return $pedidos;
                } else {
                    // Si no hay resultados, cerrar la conexión y devolver un array vacío
                    $con->close();
                    return array();
                }
            } else {
                // Si no se encuentra el usuario, cerrar la conexión y devolver un array vacío
                $con->close();
                return array();
            }
        } else {
            // Si el email del usuario no está en la sesión, devolver un array vacío
            return array();
        }
    }
    public static function obtenerDetallesDelPedido($idPedido)
    {
        // Realiza la conexión a la base de datos (reemplaza los valores con los tuyos)
        $con = DataBase::connect();

        // Verifica la conexión
        if ($con->connect_error) {
            die("Conexión fallida: " . $con->connect_error);
        }

        // Consulta SQL para obtener los detalles del pedido
        $sql = "SELECT pa.ID_PRODUCTO, p.NOMBRE_PRODUCTO, p.IMG, pa.CANTIDAD, pa.PRECIO 
        FROM pedido_articulos pa
        INNER JOIN productos p ON pa.ID_PRODUCTO = p.ID_PRODUCTO
        WHERE pa.ID_PEDIDO = $idPedido";

        // Ejecuta la consulta
        $result = $con->query($sql);

        // Verifica si hay resultados
        if ($result->num_rows > 0) {
            // Crea un array para almacenar los detalles del pedido
            $detallesPedido = array();

            // Recorre los resultados y agrega los detalles al array
            while ($row = $result->fetch_assoc()) {
                $detallesPedido[] = $row;
            }

            // Cierra la conexión y devuelve el array de detalles del pedido
            $con->close();
            return $detallesPedido;
        } else {
            // Si no hay resultados, cierra la conexión y devuelve un array vacío
            $con->close();
            return array();
        }
    }


    public static function visualizarPedido($idPedido)
    {
        // Ejemplo de cómo podrías obtener los detalles del pedido (adaptar según tu estructura)
        $detallesPedido = usuarioController::obtenerDetallesDelPedido($idPedido);

        // Incluye la plantilla de detalles_pedido.php
        include 'views/detalles_pedidos.php';
    }


    public static function obtenerPermisoUsuario($email)
    {
        // Obtén la conexión a la base de datos y otras configuraciones necesarias
        $conn = DataBase::connect(); // Ajusta según tu clase de conexión

        // Inicializa una variable para almacenar el permiso del usuario
        $permisoUsuario = 1; // Valor predeterminado, puedes ajustarlo según tu lógica

        // Consulta para obtener el permiso del usuario según el correo electrónico
        $sql = "SELECT PERMISO FROM usuarios WHERE CORREO = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $email);

        // Ejecuta la consulta
        $stmt->execute();

        // Obtiene el resultado de la consulta
        $result = $stmt->get_result();

        // Verifica si se obtuvo un resultado
        if ($result) {
            // Verifica si se encontró un usuario con el correo electrónico proporcionado
            if ($result->num_rows > 0) {
                // Obtiene el permiso del usuario
                $row = $result->fetch_assoc();
                $permisoUsuario = $row['PERMISO'];
            } else {
                // Maneja el caso en que no se encuentre ningún usuario con el correo electrónico proporcionado
                echo "No se encontró ningún usuario con el correo electrónico proporcionado.";
            }
        } else {
            // Maneja el caso en que haya un problema con la consulta SQL
            echo "Error en la consulta SQL: " . $stmt->error;
        }

        // Cierra la consulta y la conexión
        $stmt->close();
        $conn->close();

        // Devuelve el permiso del usuario
        return $permisoUsuario;
    }






}




?>