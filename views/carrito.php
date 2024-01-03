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
    <div class="col-right-opc">
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
                                        <img src="img/icons/borrar.png" alt="Eliminar">
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