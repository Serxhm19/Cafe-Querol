<?php include 'cabecera.php'; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Tu Título</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css"
        integrity="sha384-rbs5XWOCdAyJGsmOpn2iJ08eLOF9Hfe/JG9FCYnE1R8krs/Em9i1aFm51R5B5kxF" crossorigin="anonymous">
    <!-- Otros estilos y scripts aquí -->
</head>

<body>
    <section>
        <div id="testimonials" class="carousel slide" data-bs-ride="carousel" data-bs-keyboard="true">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="testimonial-img" src="img/IMGHome/Beige Brown Abstract Modern Coffee Shop Banner.png"
                        alt="dog-image">
                </div>
                <div class="carousel-item">
                    <img class="testimonial-img"
                        src="img/IMGHome/liquido-espumoso-vertido-taza-cafe-acero-generado-ia.jpg" alt="lady-img">
                </div>
            </div>
            <!-- Carousel Buttons -->
            <button class="carousel-control-prev" type="button" data-bs-target="#testimonials" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#testimonials" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>
        </div>
    </section>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12 col-lg-4">
                <div class="category">
                    <img src="img/products/tazacafe.png" alt="tazacafe" class="img-fluid">
                    <a href="?controller=producto&action=bebidas" class="btn btn-light mt-2">BEBIDAS</a>
                </div>
            </div>
            <div class="col-md-4 col-lg-4">
                <div class="category">
                    <img src="img/products/muffinred.jpg" alt="muffin" class="img-fluid">
                    <a href="?controller=producto&action=alimentacion" class="btn btn-light mt-2">ALIMENTACIÓN</a>
                </div>
            </div>
            <div class="col-md-4 col-lg-4">
                <div class="category">
                    <img src="img/products/pack.png" alt="pack" class="img-fluid">
                    <a href="?controller=producto&action=packs" class="btn btn-light mt-2">PACKS</a>
                </div>
            </div>
        </div>
    </div>

    <section class="topventas">
        <div class="container mt-4">
            <div class="row">
                <div class="col-12">
                    <div class="topVentas">
                        <h2>Top Ventas</h2>
                    </div>
                </div>
            </div>
            <div class="row imagenestopVentas">
                <?php
                $productos = productoDAO::getAllProductoHome();
                $productCount = 0; // Inicializamos un contador
                
                if ($productos && count($productos) > 0) {
                    foreach ($productos as $producto) {
                        if ($productCount >= 5) {
                            break; // Detiene el bucle una vez que se han mostrado 5 productos
                        }

                        // Formatea el precio con comas en lugar de puntos
                        $precioFormateado = number_format($producto->PRECIO, 2, ',', '.');

                        ?>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-2 mb-3">
                            <div class="card cartaproducto">
                                <img src="<?= $producto->IMG; ?>" class="card-img-top" alt="Imagen del producto">
                                <div class="card-body">
                                    <p class="card-title name">
                                        <?= $producto->NOMBRE_PRODUCTO; ?>
                                    </p>
                                    <h2 class="card-text price">
                                        <?= $precioFormateado . " €"; ?>
                                    </h2>
                                    <form action="?controller=producto&action=sel" method="post">
                                        <input type="hidden" name="product_id" value="<?= $producto->ID_PRODUCTO; ?>">
                                        <input type="hidden" name="product_name" value="<?= $producto->NOMBRE_PRODUCTO; ?>">
                                        <input type="hidden" name="product_price" value="<?= $producto->PRECIO; ?>">
                                        <input type="hidden" name="product_img" value="<?= $producto->IMG; ?>">
                                        <input type="hidden" name="product_description" value="<?= $producto->DESCRIPCION; ?>">
                                        <button type="submit" class="btn-hover add-to-cart-btn">
                                            Añadir al Carrito
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php
                        $productCount++; // Incrementa el contador de productos mostrados
                    }
                } else {
                    echo "<p>No se encontraron productos.</p>";
                }
                ?>
            </div>
        </div>
    </section>

    <section>
        <hr>
        <div class="row">
            <div class="logoQuerol d-md-flex flex-md-row">
                <div class="col-12 col-md-3 col-sm-6">
                    <picture>
                        <source media="(min-width: 576px)" srcset="img/IMGHome/logoquerol.webp">
                        <img src="img\icons\logoQuerol.jpg" alt="logo" class="img-fluid" style="max-width: 390px;">
                    </picture>
                </div>
                <div class="col-12 col-md-6 d-none d-md-block">
                    <p>¡Bienvenido a la Cafetería Querol! En un mundo donde la moda y el estilo se combinan a la
                        perfección,
                        hemos creado un espacio que refleja la esencia de la tienda de zapatos Querol. En nuestra
                        cafetería,
                        no solo podrás disfrutar de deliciosos aromas y sabores, sino también de un ambiente elegante y
                        acogedor que complementa a la perfección la experiencia de compra en Querol. Desde exquisitos
                        cafés
                        hasta dulces y bocadillos artesanales, nuestra cafetería es el lugar ideal para relajarse y
                        recargar
                        energías mientras exploras las últimas tendencias en calzado y accesorios. Descubre un rincón
                        donde
                        la moda y la gastronomía se encuentran, solo en la Cafetería Querol. </p>
                </div>
            </div>
        </div>
    </section>

    <hr>
    <!-- Newsletter Section -->
    <div class="newsletter mt-4">
        <h3>¿Quieres recibir nuestras ofertas y novedades?</h3>
        <div class="row">
            <div class="col-md-6">
                <input type="text" class="form-control" placeholder="Introduce tu e-mail para suscribirte">
            </div>
            <div class="col-md-6 mt-2 mt-md-0">
                <button type="button" class="btn btn-primary">ENVIAR</button>
            </div>
        </div>
    </div>

    <!-- Privacy Checkbox Section -->
    <div class="privacy-checkbox mt-2">
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="privacyCheckbox">
            <label class="form-check-label" for="privacyCheckbox">
                He leído y acepto la <a href="#">Política de privacidad</a>
            </label>
        </div>
    </div>
</body>

<footer>
    <?php include 'footer.php'; ?>
</footer>

</html>