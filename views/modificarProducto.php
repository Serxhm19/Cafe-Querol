<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-SsDkMO9SMV3F8C3QvxZjScNB6eScB8peVp/UL6ZI3jFhAxVdfdC4vhm3ZXiU04QE"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="Style\stylemodificarproducto.css">
    <link rel="icon" type="image/jpg" href="img\icons\logoQuerol.jpg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Café Querol | Tu cafeteria de confianza</title>
</head>

<header>
    <section>
        <section>
            <div class="row">
                <div class="Header2 col-12 col-md-4 text-sm-center">
                    <img src="img/icons/coffee.png" alt="coffee">
                    <h3 class="text-sm">TOMA LO QUE QUIERAS MIENTRAS COMPRAS</h3>
                </div>
                <div class="Header2 col-12 col-md-4 text-sm-center">
                    <img src="img/icons/coffee-cup.png" alt="coffee">
                    <h3 class="text-sm">COME AQUI O LLEVATELO A CASA</h3>
                </div>
                <div class="Header2 col-12 col-md-4 text-sm-center">
                    <img src="img/icons/cake.png" alt="cake">
                    <h3 class="text-sm">SERVICIO DE COMIDA</h3>
                </div>
            </div>
        </section>
        <section>
            <div class="header3">
                <nav class="navbar navbar-expand-lg bg-body-tertiary">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="?controller=producto"><img src="img\IMGHome\logo_principal.png"
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
                            </ul>
                            <form class="d-flex" role="search">
                                <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Buscar">
                                <button class="btn" type="submit">Buscar</button>
                            </form>
                            <a class="navbar-account" href="?controller=usuario&action=redirectToPage"><img
                                    src="img\icons\icon-account.png" alt="logo"></a>
                            <a class="navbar-cart" href="?controller=producto&action=Carrito">
                                <img src="img\icons\carrito-de-compras.png" alt="logo">
                                <?php
                                include_once("utils/Funciones.php");
                                // Llamar a la función contarProductosEnCarrito() para obtener el número de productos
                                $numeroProductos = contarProductosEnCarrito();

                                // Mostrar el número de productos solo si es mayor que cero
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
    <div class="row">
        <div class="col-md-9">
            <div class="formulario">
                <h2>Modificar Producto</h2>
                <?php
                // Verifica si se han pasado detalles del producto
                if (!empty($detallesProducto)) {
                    // Mostrar el formulario de modificación
                    echo '<form method="post" action="?controller=producto&action=procesarModificarProducto">';

                    // Utiliza la notación de flecha para acceder a las propiedades del objeto
                    echo '<input type="hidden" name="idProducto" value="' . $detallesProducto->ID_PRODUCTO . '" min ="1" max="3">';

                    echo '<label for="idCategoria">ID Categoría:</label>';
                    echo '<input type="number" name="idCategoria" value="' . $detallesProducto->ID_CATEGORIA . '" min="1" max="3">';

                    echo '<label for="nombreProducto">Nombre del Producto:</label>';
                    echo '<input type="text" name="nombreProducto" value="' . $detallesProducto->NOMBRE_PRODUCTO . '" required>';

                    echo '<label for="descripcion">Descripción:</label>';
                    echo '<textarea name="descripcion" required>' . $detallesProducto->DESCRIPCION . '</textarea>';

                    echo '<label for="precio">Precio:</label>';
                    echo '<input type="number" name="precio" value="" step="0.01"' . $detallesProducto->PRECIO . '" required>';

                    echo '<label for="cantidad">Cantidad:</label>';
                    echo '<input type="number" name="cantidad" value=" ' . $detallesProducto->CANTIDAD . '" required>';

                    echo '<label for="img">URL de la Imagen:</label>';
                    echo '<input type="text" name="img" value="' . $detallesProducto->IMG . '" required>';

                    // Botón de modificar
                    echo '<input type="submit" value="Modificar">';

                    echo '</form>';
                } else {
                    echo 'Error: No se encontraron detalles del producto.';
                }
                ?>


            </div>
            <a href="?controller=usuario&action=adminPage" class="btn btn-secondary cerrar">Cerrar</a>

        </div>
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