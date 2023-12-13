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
            $sql = "SELECT CORREO, PASSWORD, PERMISO FROM usuarios WHERE CORREO = ? AND PASSWORD = ?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param('ss', $inputEmail, $inputPassword);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $stmt->bind_result($email, $password, $userPermission);
                $stmt->fetch();

                // Verifica la contraseña directamente
                if ($inputPassword === $password) {
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
            $contrasena = $_POST["contrasena"]; // Hashear la contraseña
            $correo = $_POST["correo"];
            $telefono = $_POST["telefono"];
            $direccion = $_POST["direccion"];

            // Crear una instancia de usuarioEstandar y establecer los datos
            $usuario = new UsuarioEstandar($nombre, $apellido, $contrasena, $correo, $telefono, $direccion);

            // Guardar el usuario en la base de datos
            $con = DataBase::connect(); // Ajusta según tu clase de conexión

            $sql = "INSERT INTO usuarios (NOMBRE, APELLIDO, PASSWORD, CORREO, TELEFONO, DIRECCION, PERMISO) 
VALUES (?, ?, ?, ?, ?, ?, 1)";

            $stmt = $con->prepare($sql);

            // Bind de parámetros
            $stmt->bind_param('ssssss', $nombre, $apellido, $contrasena, $correo, $telefono, $direccion);

            if ($stmt->execute()) {
                header("Location: ?controller=usuario&action=login"); // Redirige de nuevo a la página de inicio de sesión con el mensaje de error
            } else {
                echo "Error al registrar el usuario.";
            }
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
                        } else {
                            $_SESSION['errorMessage'] = "Error al preparar la consulta.";
                        }
                    } else {
                        $_SESSION['errorMessage'] = "El nuevo correo electrónico debe ser diferente del actual.";
                    }
                } else {
                    $_SESSION['errorMessage'] = "Contraseña incorrecta. Intenta nuevamente.";
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

                // Verifica la contraseña
                if ($inputPassword == $storedPassword) {
                    // Contraseña correcta, procede a actualizar la contraseña
                    if ($newPassword == $confirmPassword) {
                        // Actualiza la contraseña en la base de datos solo si las nuevas contraseñas coinciden
                        $sqlUpdatePassword = "UPDATE usuarios SET PASSWORD = ? WHERE ID_USUARIO = ?";
                        $stmtUpdatePassword = $con->prepare($sqlUpdatePassword);
                        $stmtUpdatePassword->bind_param('si', $newPassword, $userId);

                        // Verifica si la preparación de la consulta fue exitosa
                        if ($stmtUpdatePassword) {
                            if ($stmtUpdatePassword->execute()) {
                                // Actualización exitosa
                                $_SESSION['successMessage'] = "Contraseña actualizada con éxito.";
                                header("Location: ?controller=usuario&action=dashboard");
                                exit();
                            } else {
                                $_SESSION['errorMessage'] = "Error al actualizar la contraseña.";
                            }

                            // Cierra la declaración preparada
                            $stmtUpdatePassword->close();
                        } else {
                            $_SESSION['errorMessage'] = "Error al preparar la consulta.";
                        }
                    } else {
                        $_SESSION['errorMessage'] = "Las nuevas contraseñas no coinciden.";
                    }
                } else {
                    $_SESSION['errorMessage'] = "Contraseña actual incorrecta. Intenta nuevamente.";
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



?>