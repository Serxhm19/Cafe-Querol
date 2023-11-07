<body>
    <div class="container">
        <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="img/liquido-espumoso-vertido-taza-cafe-acero-generado-ia.jpg" class="d-block w-100"
                        alt="...">
                </div>
                <div class="carousel-item">
                    <img src="img/conjunto-fresco-hermoso-taza-cafe-manana-relajacion.jpg" class="d-block w-100"
                        alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="category">
                    <img src="img/tazacafe.png" alt="tazacafe">
                    <button type="button" class="btn btn-light">Bebidas</button>
                </div>
            </div>
            <div class="col-4">
                <div class="category">
                    <img src="img/muffinred.jpg" alt="muffin">
                    <button type="button" class="btn btn-light">Alimentación</button>
                </div>
            </div>
            <div class="col-4">
                <div class="category">
                    <img src="img/pack.png" alt="pack">
                    <button type="button" class="btn btn-light">Packs</button>
                </div>
            </div>
        </div>
    </div>
    <section>
        <div class="row">
            <div class="topVentas">
                <h2>TOP VENTAS</h2>
            </div>
        </div>
        <div class="row imagenestopVentas">
            <?php
            include 'model/productosHome.php';

            $productos = productoHome::getAllProducto();
            $productCount = 0; // Inicializamos un contador
            
            if ($productos && count($productos) > 0) {
                foreach ($productos as $producto) {
                    if ($productCount >= 5) {
                        break; // Detiene el bucle una vez que se han mostrado 5 productos
                    }
                    ?>
                    <div class="col-2">
                        <div class="card">
                            <img src="<?= $producto['IMG']; ?>" class="card-img-top" alt="Imagen del producto">
                            <div class="card-body">
                                <p class="card-title">
                                    <?= $producto['NOMBRE_PRODUCTO']; ?>
                                </p>
                                <h2 class="card-text">
                                    <?= $producto['PRECIO'] . "€"; ?>
                                </h2>
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
    </section>
    <section>
        <hr>
        <div class="row">
            <div class="logoQuerol">
                <div class="col-3">
                    <img src="img/logoquerol.png" alt="logo">
                </div>
                <div class="col-9">
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
    <div class="newsletter">
        <h3>¿Quieres recibir nuestras ofertas y novedades?</h3>
        <div>
            <input type="text" placeholder="Introduce tu e-mail para suscribirte">
            <button type="button">ENVIAR</button>
        </div>
    </div>
    <div class="privacy-checkbox">
        <input type="checkbox">
        <p>He leído y acepto la <a href="#">Política de privacidad</a></p>
    </div>

    </section>
</body>

</html>