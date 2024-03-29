<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-SsDkMO9SMV3F8C3QvxZjScNB6eScB8peVp/UL6ZI3jFhAxVdfdC4vhm3ZXiU04QE"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="Style/styledetallespedido.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
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

    <body>
        <div class="container">

            <h2>Detalles del Pedido</h2>
            <p>ID Pedido:
                <?php echo $idPedido; ?>
            </p>

            <h3>Productos del Pedido</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($detallesPedido as $detalle): ?>
                        <tr>
                            <td><img src="<?php echo $detalle['IMG']; ?>" alt="<?php echo $detalle['NOMBRE_PRODUCTO']; ?>">
                            </td>
                            <td>
                                <?php echo $detalle['NOMBRE_PRODUCTO']; ?>
                            </td>
                            <td>
                                <?php echo $detalle['CANTIDAD']; ?>
                            </td>
                            <td>
                                <?php echo $detalle['PRECIO']; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <a href="?controller=usuario&action=mispedidos" class="btn btn-secondary">Cerrar</a>
        </div>
    </body>

</html>