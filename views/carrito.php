<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                <div class="row">
                    <div class="col-md-10">
                        <p class="card-text Resume">
                            Propina:
                        </p>
                    </div>
                    <div class="col-md-2 totalPrice">
                        <p class="card-text totalPrice"><span id="cantidad-propina">0</span> €</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <p class="card-text Resume">
                            Descuento:
                        </p>
                    </div>
                    <div class="col-md-2 totalPrice">
                        <p class="card-text totalPrice"><span id="cantidad-descuento">0</span> €</p>
                    </div>
                </div>
                <div class="row finalPrice custom-background">
                    <div class="col-md-10">
                        <p class="card-text Resume2">
                            Total (IVA Incluido):
                        </p>
                    </div>
                    <div class="col-md-2 card-text totalPrice2">
                        <p><span id="total-con-propina-valor">0</span> €</p>
                    </div>
                </div>

                <div class="propina">
                    <h2>¿Desea dejar propina?</h2>
                    <label class="toggle-label">
                        <input type="radio" name="propina-option" id="propina-toggle" class="toggle-input" checked>
                        <span class="toggle-button">Seleccionar propina personalizada</span>
                    </label>
                    <label class="toggle-label">
                        <input type="radio" name="propina-option" id="omitir-propina" class="toggle-input">
                        <span class="toggle-button">Omitir propina</span>
                    </label>
                    <div id="propina-slider" style="display: block;">
                        <input type="range" id="propina-range" name="propina" min="1" max="100" value="3">
                        <label for="propina-range" id="propina-value">3%</label>
                    </div>
                    <h2>¿Desea usar sus puntos?</h2>
                    <input type="number" id="cantidadPuntos" name="cantidadPuntos"
                        placeholder="Ingrese la cantidad de puntos a utilizar" min="0"
                        max="<?php echo usuarioController::obtenerpuntos(); ?>" oninput="actualizarPrecioFinal()">
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
                        <button type="submit" id="btnPagar" class="btnPagar">Pagar</button>
                    </form>
                    <?php
            } else {
                echo "<p class='text-center'>No hay productos en el carrito.</p>";
            }
            ?>
            </div>
        </div>
        <script>
            $('#btnPagar').click(function (e) {
                e.preventDefault(); // Evita que el formulario se envíe de forma normal

                // Obtén los datos del formulario
                var formData = $('form').serialize();

                // Realiza una solicitud AJAX al servidor
                $.ajax({
                    type: 'POST',
                    url: '?controller=producto&action=insertarDetallesPedido',
                    data: formData,
                    success: function (response) {
                        // Genera el código QR una vez que se haya enviado el formulario
                        var qrCodeBaseUri = 'https://api.qrserver.com/v1/create-qr-code/?';
                        var params = {
                            data: 'https://workspace.com/Workspace/Cafe-Querol/?controller=usuario&action=QR',
                            size: '150x150',
                            margin: 1
                        };

                        // Construye la URL del código QR
                        var qrCodeUrl = qrCodeBaseUri + $.param(params);

                        // Muestra el código QR en un div debajo del botón de "Pagar"
                        $('#qrCodeContainer').html('<img src="' + qrCodeUrl + '" alt="QR Code">');

                        // Muestra el botón para ir a "Mis pedidos"
                        $('#goToOrders').show();

                        // Realiza la llamada AJAX para agregar puntos al usuario
                        $.ajax({
                            type: 'POST',
                            url: '?controller=API&action=api', // Verifica y actualiza la URL según corresponda
                            data: {
                                accion: 'add_points_to_user', // Verifica que coincida con el nombre de la acción en el servidor
                                precio_total_carrito: <?= $precios['precioTotalCarrito'] ?> // Agrega el precio total del carrito como dato
                            },
                            success: function (response) {
                                // Aquí puedes manejar la respuesta del servidor si es necesario
                                console.log(response);
                            },
                            error: function (jqXHR, textStatus, errorThrown) {
                                console.log(textStatus, errorThrown);
                            }
                        });
                        
                        // Obtener la cantidad de puntos a utilizar desde el input
                        var puntosUtilizados = document.getElementById('cantidadPuntos').value;

                        // Crear un objeto con los datos a enviar
                        var data = {
                            accion: 'subtract_points_from_user', // Nombre de la acción en la API
                            cantidadPuntos: puntosUtilizados // Cantidad de puntos a utilizar
                        };

                        // Realizar una solicitud AJAX al servidor
                        $.ajax({
                            type: 'POST', // Método HTTP
                            url: '?controller=API&action=api', // URL del controlador y acción de la API
                            data: data, // Datos a enviar
                            dataType: 'json', // Tipo de datos esperados en la respuesta
                            success: function (response) {
                                // Manejar la respuesta del servidor
                                console.log(response); // Por ejemplo, imprimir la respuesta en la consola
                            },
                            error: function (jqXHR, textStatus, errorThrown) {
                                // Manejar errores de la solicitud AJAX
                                console.error(textStatus, errorThrown);
                            }
                        });

                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            });


            document.addEventListener('DOMContentLoaded', function () {
                // Obtener referencias a elementos HTML relevantes
                var propinaToggle = document.getElementById('propina-toggle');
                var propinaSlider = document.getElementById('propina-slider');
                var propinaRange = document.getElementById('propina-range');
                var propinaValue = document.getElementById('propina-value');
                var cantidadPropina = document.getElementById('cantidad-propina');
                var totalConPropinaValor = document.getElementById('total-con-propina-valor');
                var totalPedidoElement = document.querySelector('.totalPrice'); // Ajusta el selector según la clase o ID del elemento que contiene el precio total
                var totalPedido = parseFloat(totalPedidoElement.textContent.replace(' €', '').replace(',', '.')); // Elimina el símbolo € y convierte el valor a número
                var cantidadPuntosInput = document.getElementById('cantidadPuntos');

                // Función para actualizar el valor del porcentaje de propina, el total con propina y aplicar el descuento por puntos
                function actualizarValores() {
                    // Obtener el valor del descuento por puntos
                    var puntos = parseInt(cantidadPuntosInput.value);
                    var descuento = puntos / 100 * 0.2;

                    // Obtener el valor de la propina
                    var porcentajePropina = propinaRange.value;
                    var propina = (totalPedido * porcentajePropina) / 100;

                    // Calcular el total con propina y aplicar el descuento por puntos
                    var totalConPropina = totalPedido + propina - descuento;

                    // Actualizar el valor del porcentaje de propina y el total con propina en los elementos HTML
                    propinaValue.textContent = porcentajePropina + '%';
                    cantidadPropina.textContent = propina.toFixed(2);
                    // Actualizar el valor total del pedido incluyendo la propina y aplicando el descuento por puntos
                    totalConPropinaValor.textContent = totalConPropina.toFixed(2);
                }

                // Actualizar el precio total al cargar la página
                actualizarValores();

                // Escuchar cambios en los checkboxes de propina
                propinaToggle.addEventListener('change', function () {
                    if (this.checked) {
                        // Mostrar el slider y actualizar el total con propina si se selecciona la propina
                        propinaSlider.style.display = 'block';
                        // Actualizar los valores considerando la propina y el descuento por puntos
                        actualizarValores();
                        document.getElementById('total-con-propina').style.display = 'block';
                        // Desmarcar el checkbox de omitir propina si se selecciona la propina
                        document.getElementById('omitir-propina').checked = false;
                    } else {
                        // Ocultar el slider si no se selecciona la propina
                        propinaSlider.style.display = 'none';
                        // Restaurar el precio total sin propina y aplicando el descuento por puntos
                        actualizarValores();
                        document.getElementById('total-con-propina').style.display = 'block'; // Mostrar siempre el precio total
                    }
                });

                // Escuchar cambios en el checkbox de omitir propina
                document.getElementById('omitir-propina').addEventListener('change', function () {
                    if (this.checked) {
                        // Establecer la propina a 0 si se selecciona omitir propina
                        cantidadPropina.textContent = '0.00';
                        // Actualizar el total con propina a 0 y aplicando el descuento por puntos
                        totalConPropinaValor.textContent = totalPedido.toFixed(2);
                        // Desmarcar el checkbox de propina si se selecciona omitir propina
                        document.getElementById('propina-toggle').checked = false;
                        // Ocultar el slider de propina si se selecciona omitir propina
                        propinaSlider.style.display = 'none';
                    } else {
                        // Mostrar el slider si se deselecciona omitir propina y está seleccionada la propina
                        if (propinaToggle.checked) {
                            propinaSlider.style.display = 'block';
                        }
                        // Actualizar los valores considerando la propina y el descuento por puntos
                        actualizarValores();
                    }
                });

                // Escuchar cambios en el rango de propina
                propinaRange.addEventListener('input', function () {
                    // Actualizar los valores del porcentaje de propina, la propina y el total con propina
                    actualizarValores();
                });

                // Escuchar cambios en la cantidad de puntos
                cantidadPuntosInput.addEventListener('input', function () {
                    // Actualizar los valores considerando el descuento por puntos
                    actualizarValores();
                });
            });


        </script>


        <!-- Agrega este div para mostrar el código QR -->
        <div id="qrCodeContainer"></div>

        <!-- Agrega este botón para ir a "Mis pedidos" -->
        <a href="?controller=usuario&action=mispedidos" class="btn btn-secondary">Mis Pedidos</a>
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