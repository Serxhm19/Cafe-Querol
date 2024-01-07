<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="Style/stylecarrito.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpg" href="img\icons\logoQuerol.jpg">
    <title>Carrito</title>
</head>

<body>
    <div class="HeaderCarrito">
        <a href="?controller=producto">
            <img src="img\IMGHome\logo_principal.png" alt="logoQuerol">
        </a>
    </div>

    <div class="col-right-opc d-none d-md-block">
        <div class="headerColRight">
            <div class="iconColRight">
                <img src="img\icons\image-2duaS2.png" alt="icon">
            </div>
            <h1>RESUMEN DEL PEDIDO</h1>
            <div class="contadorProductos">
                <?php
                include_once("utils/Funciones.php");
                // Llama a la función para contar productos en el carrito
                $cantidadProductos = contarProductosEnCarrito2();
                // Obtener los detalles del precio del carrito, envío y total usando la función
                $precios = calcularPrecioTotal($_SESSION['cart']);

                // Muestra el contador si hay productos en el carrito
                if ($cantidadProductos > 0) {
                    echo "<p>$cantidadProductos Productos</p>";
                }
                ?>
            </div>
            <div class="detallesEnvio2 row">
                <div class="col-1">
                    <img src="img\icons\image-2duaS.png" alt="camion">
                </div>
                <div class="col-11">
                    <h4>Recíbelo en 3-5 días laborables</h4>
                </div>
            </div>
            <hr>
            <div class="Resumenpedido">
                <?php
                // Include the sumarPrecioPorId function
                include_once("utils/Funciones.php");

                // Verificar si hay productos en el carrito
                if (!empty($_SESSION['cart'])) {
                    // Mostrar detalles de cada producto en el carrito
                    foreach ($_SESSION['cart'] as $producto) {
                        // Calcular el total del producto
                        $totalProducto = $producto['quantity'] * $producto['price'];

                        ?>
                        <div class="Resumenpedido row">
                            <div class="col-md-2">
                                <img src="<?= isset($producto['img']) ? $producto['img'] : ''; ?>" class="card-img-top"
                                    alt="Imagen del producto">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <div class="cardBodyPrice">
                                        <h5 class="card-title name">
                                            <?= isset($producto['name']) ? $producto['name'] : ''; ?>
                                        </h5>
                                        <p class="description">
                                            <?= isset($producto['description']) ? $producto['description'] : ''; ?>
                                        </p>
                                        <p class="card-text price">
                                            <?= number_format($totalProducto, 2, ',', ' ') ?> €
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <form method="post" action="?controller=producto&action=removeProduct">
                                    <input type="hidden" name="productId"
                                        value="<?= isset($producto['id']) ? $producto['id'] : ''; ?>">
                                    <!-- Enlace que actúa como botón para eliminar el producto -->
                                    <a href="#" class="remove-button" onclick="this.closest('form').submit(); return false;">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            width="28px" height="28px" viewBox="0 0 28 28" version="1.1">
                                            <title>cancelar (1)</title>
                                            <g id="checkout" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <g id="desk-registro-new_user" transform="translate(-1373.000000, -258.000000)"
                                                    fill="#E2001A" fill-rule="nonzero">
                                                    <g id="cancelar-(1)" transform="translate(1373.000000, 258.000000)">
                                                        <path
                                                            d="M23.8989899,4.1010101 C21.253367,1.45538721 17.7415825,0 14,0 C10.2584175,0 6.746633,1.45538721 4.1010101,4.1010101 C1.45538721,6.746633 0,10.2584175 0,14 C0,17.7415825 1.45538721,21.253367 4.1010101,23.8989899 C6.746633,26.5446128 10.2584175,28 14,28 C17.7415825,28 21.253367,26.5446128 23.8989899,23.8989899 C26.5446128,21.253367 28,17.7415825 28,14 C28,10.2584175 26.5446128,6.746633 23.8989899,4.1010101 Z M22.773569,22.773569 C20.4284512,25.1186869 17.3114478,26.4090909 14,26.4090909 C10.6885522,26.4090909 7.57154882,25.1186869 5.22643098,22.773569 C0.388888889,17.9360269 0.388888889,10.0639731 5.22643098,5.22643098 C7.57154882,2.88131313 10.6885522,1.59090909 14,1.59090909 C17.3114478,1.59090909 20.4284512,2.88131313 22.773569,5.22643098 C27.6111111,10.0639731 27.6111111,17.9360269 22.773569,22.773569 Z"
                                                            id="Shape"></path>
                                                        <path
                                                            d="M20.3472577,7.65271454 C20.0259543,7.33144809 19.5106564,7.33144809 19.189353,7.65271454 L14,12.8414708 L8.81064696,7.65271454 C8.48934356,7.33144809 7.97404566,7.33144809 7.65274226,7.65271454 C7.33143886,7.97398099 7.33143886,8.48921963 7.65274226,8.81048608 L12.8420953,13.9992423 L7.65274226,19.1879985 C7.33143886,19.509265 7.33143886,20.0245036 7.65274226,20.3457701 C7.81036279,20.5033725 8.02254428,20.5882353 8.22866345,20.5882353 C8.43478261,20.5882353 8.6469641,20.5094341 8.80458464,20.3457701 L13.9939377,15.1570138 L19.1832907,20.3457701 C19.3409112,20.5033725 19.5530927,20.5882353 19.7592119,20.5882353 C19.9713934,20.5882353 20.1775126,20.5094341 20.3351331,20.3457701 C20.6564365,20.0245036 20.6564365,19.509265 20.3351331,19.1879985 L15.1579047,13.9992423 L20.3472577,8.81048608 C20.6685611,8.48921963 20.6685611,7.97398099 20.3472577,7.65271454 Z"
                                                            id="Path"></path>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </a>

                                </form>
                            </div>
                        </div>
                        <hr>
                        <?php
                    }
                } else {
                    echo "<p class='text-center'>No hay productos en el carrito.</p>";
                }
                ?>
                <!-- Mostrar el precio total al final del div -->
                <div class="row">
                    <div class="col-md-10">
                        <p class="card-text Resume">
                            Total Pedido:
                        </p>
                    </div>
                    <div class="col-md-2">
                        <p class="card-text totalPrice">
                            <?= number_format($precios['precioTotalCarrito'], 2, ',', ' ') ?> €
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <p class="card-text Resume">
                            Envío:
                        </p>
                    </div>
                    <div class="col-md-2">
                        <p class="card-text totalPrice">
                            <?= number_format($precios['precioEnvio'], 2, ',', ' ') ?> €
                        </p>
                    </div>
                </div>
                <div class="row finalPrice custom-background">
                    <div class="col-md-10">
                        <p class="card-text Resume2">
                            Total (IVA Incluido):
                        </p>
                    </div>
                    <div class="col-md-2">
                        <p class="card-text totalPrice2">
                            <?= number_format($precios['precioTotal'], 2, ',', ' ') ?> €
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-left-opc">
        <div class="container steps-container">
            <div class="col-12 steps">
                <img src="img\IMGHome\CartSteps.png" alt="steps">
            </div>
        </div>
        <hr>
        <div class="detallesEnvio">
            <h2>¿Donde te lo enviamos?</h2>
            <h3>Detalles de envio</h3>
            <div class="detallesEnvio icon-text-container">
                <img src="img\icons\image-2duaS.png" alt="camion">
                <h4>Recíbelo en 3-5 días laborables</h4>
            </div>
        </div>
        <div class="resumencompra container">
            <hr>
            <!-- Mostrar los productos del carrito aquí -->
            <?php
            // Inicializar el precio total del carrito
            $precioTotalCarrito = 0;

            // Verificar si hay productos en el carrito
            if (!empty($_SESSION['cart'])) {
                // Mostrar detalles de cada producto en el carrito
                foreach ($_SESSION['cart'] as $producto) {
                    // Calcular el total del producto
                    $totalProducto = calcularTotalProducto(
                        isset($producto['price']) ? $producto['price'] : 0,
                        isset($producto['quantity']) ? $producto['quantity'] : 0
                    );

                    // Sumar el total del producto al precio total del carrito
                    $precioTotalCarrito += $totalProducto;
                    ?>
                    <div class="cartProducts row">
                        <div class="col-md-2">
                            <img src="<?= isset($producto['img']) ? $producto['img'] : ''; ?>" class="card-img-top"
                                alt="Imagen del producto">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <div class="cardBodyPrice">
                                    <h5 class="card-title name">
                                        <?= isset($producto['name']) ? $producto['name'] . ' (' . $producto['quantity'] . ')' : ''; ?>
                                    </h5>
                                    <p class="description">
                                        <?= isset($producto['description']) ? $producto['description'] : ''; ?>
                                    </p>
                                    <p class="card-text price">
                                        <?= number_format($totalProducto, 2, ',', ' ') ?> €
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <?php
                }

                ?>
                <div class="direccionEnvio">
                    <h1>Dirección de envío</h1>
                    <?php $cliente = usuarioController::obtenerDatosCliente(); ?>
                    <div class="styled-container">
                        <div class="direccionEnvio">
                            <?php
                            // Verifica si se obtuvieron datos del cliente
                            if ($cliente) {
                                echo '<p> ' . $cliente->NOMBRE . '</p>';
                                echo '<p> ' . $cliente->APELLIDO . '</p>';
                                echo '<p> ' . $cliente->CORREO . '</p>';
                                echo '<p> ' . $cliente->TELEFONO . '</p>';
                                echo '<p> ' . $cliente->DIRECCION . '</p>';
                            } else {
                                echo '<p>No se encontraron datos del cliente.</p>';
                            }
                            ?>
                        </div>

                    </div>
                    <hr>
                    <form action="?controller=producto&action=insertarDetallesPedido" method="post" class="text-center">
                        <!-- Agrega campos ocultos para enviar detalles del carrito -->
                        <?php foreach ($_SESSION['cart'] as $producto): ?>
                            <input type="hidden" name="productos[<?= $producto['id'] ?>][id]" value="<?= $producto['id'] ?>">
                            <input type="hidden" name="productos[<?= $producto['id'] ?>][name]"
                                value="<?= $producto['name'] ?>">
                            <input type="hidden" name="productos[<?= $producto['id'] ?>][quantity]"
                                value="<?= $producto['quantity'] ?>">
                            <input type="hidden" name="productos[<?= $producto['id'] ?>][price]"
                                value="<?= $producto['price'] ?>">
                            <!-- Agrega más campos según sea necesario, como imagen, descripción, etc. -->
                        <?php endforeach; ?>

                        <!-- Botón para enviar el formulario -->
                        <button type="submit" class="btnPagar">Pagar</button>
                    </form>
                    <?php
            } else {
                echo "<p class='text-center'>No hay productos en el carrito.</p>";
            }
            ?>
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