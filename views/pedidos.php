<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-SsDkMO9SMV3F8C3QvxZjScNB6eScB8peVp/UL6ZI3jFhAxVdfdC4vhm3ZXiU04QE"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="Style/stylemispedidos.css">
    <meta charset="UTF-8">
    <link rel="icon" type="image/jpg" href="img\icons\logoQuerol.jpg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Pedidos</title>
</head>

<body>
    <header>
        <section>
            <div class="row">
                <div class="Header2 col-4">
                    <img src="img/icons/coffee.png" alt="coffee">
                    <h3>TOMA LO QUE QUIERAS MIENTRAS COMPRAS</h3>
                </div>
                <div class="Header2 col-4">
                    <img src="img/icons/coffee-cup.png" alt="coffee">
                    <h3>COME AQUI O LLEVATELO A CASA</h3>
                </div>
                <div class="Header2 col-4">
                    <img src="img/icons/cake.png" alt="cake">
                    <h3>SERVICIO DE COMIDA</h3>
                </div>
            </div>
        </section>
        <section>
            <div class="header3">
                <nav class="navbar navbar-expand-lg bg-body-tertiary">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="?controller=producto"><img src="img/IMGHome/logo_principal.png"
                                alt="logo"></a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="?controller=producto">HOME</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page"
                                        href="?controller=producto&action=Carta">CARTA</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page"
                                        href="?controller=producto&action=Reseñas">RESEÑAS</a>
                                </li>
                            </ul>
                            <form class="d-flex" role="search">
                                <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Buscar">
                                <button class="btn" type="submit">Buscar</button>
                            </form>
                            <a class="navbar-account" href="?controller=producto"><img src="img/icons/icon-account.png"
                                    alt="logo"></a>
                            <a class="navbar-cart" href="?controller=producto&action=Carrito">
                                <img src="img/icons/carrito-de-compras.png" alt="logo">
                                <?php
                                include_once("utils/Funciones.php");
                                $numeroProductos = contarProductosEnCarrito();
                                if ($numeroProductos > 0) {
                                    echo '<span class="cart-count">' . $numeroProductos . '</span>';
                                }
                                ?>
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
        </section>
    </header>
    <section class="breadcrumb">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="?controller=producto">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Mis Pedidos</li>
            </ol>
        </nav>
    </section>
    <div class="row">
        <div class="col-md-3">
            <div class="menumyaccount" id="cssmenu">
                <h3>Mi cuenta</h3>
                <ul>
                    <li><a href="?controller=usuario&action=dashboard" title="Mis Datos">Mis datos</a></li>
                    <hr>
                    <li>Mis Pedidos</li>
                    <hr>
                    <?php
                    // Verifica si 'email' está definido en la sesión
                    if (isset($_SESSION['email'])) {
                        $emailUsuario = $_SESSION['email'];
                        $permisoUsuario = usuarioController::obtenerPermisoUsuario($emailUsuario);
                        // Muestra el enlace solo si el permiso es 0
                        if ($permisoUsuario == 0) {
                            echo '<li><a href="?controller=usuario&action=adminPage" title="Pagina Administrador">Pagina Administrador</a></li><hr>';

                        }
                    } else {
                        echo "<li>El índice 'email' no está definido en la sesión.</li>";
                    }
                    ?>

                    <li><a href="?controller=usuario&action=CerrarSesion" title="Cerrar sesión">Cerrar sesión</a></li>
                </ul>
            </div>
        </div>

        <div class="col-md-9">
            <h2>Historial de Pedidos</h2>
            <div class="text-center mt-4">
                <?php
                // Llamamos a la función para obtener la información del último pedido
                $ultimoPedidoInfo = productoController::mostrarUltimoPedido();

                // Verificamos si hay un ID de pedido asociado en la información
                // y creamos el enlace para visualizar el pedido si es necesario
                if (isset($ultimoPedidoInfo)) {
                    echo '<a href="?controller=usuario&action=visualizarPedido&ID_PEDIDO=' . $ultimoPedidoInfo . '" class="btn btn-info">Visualizar Pedido</a>';
                }
                ?>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th>ID PEDIDO</th>
                        <th>ESTADO</th>
                        <th>FECHA DE PEDIDO</th>
                        <th>Acciones</th> <!-- Nueva columna para los botones -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include_once 'controller/usuarioController.php';

                    // Obtener pedidos del usuario loggeado
                    $pedidos = usuarioController::obtenerPedidosUsuario();

                    // Iterar sobre los pedidos y mostrarlos en la tabla
                    foreach ($pedidos as $pedido) {
                        echo "<tr>";
                        echo "<td>" . $pedido['ID_PEDIDO'] . "</td>";
                        echo "<td>" . $pedido['ESTADO'] . "</td>";
                        echo "<td>" . $pedido['FECHA_PEDIDO'] . "</td>";
                        echo "<td>";

                        // Botón para recuperar el pedido
                        echo '<a href="?controller=producto&action=recuperarPedido&ID_PEDIDO=' . $pedido['ID_PEDIDO'] . '" class="btn btn-primary">Recuperar Pedido</a>';

                        // Botón para visualizar el pedido
                        echo '<a href="?controller=usuario&action=visualizarPedido&ID_PEDIDO=' . $pedido['ID_PEDIDO'] . '" class="btn btn-info">Visualizar Pedido</a>';

                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

</body>

<footer>
    <div class="footer-up">
        <ul>
            <li>
                <img src="img/icons/facebook.png" alt="Facebook" class="social-icon">
                <img src="img/icons/facebook2.png" alt="Facebook Hover" class="social-icon-hover">
            </li>
            <li>
                <img src="img/icons/instagram.png" alt="Instagram" class="social-icon">
                <img src="img/icons/instagram2.png" alt="Instagram Hover" class="social-icon-hover">
            </li>
        </ul>
    </div>
    <div class="footer-down">
        <p>Copyright 2023 | Sergi Hernández Miras</p>
    </div>
</footer>

</html>