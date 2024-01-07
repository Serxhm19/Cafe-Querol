<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="Style/stylecarta.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
</head>

<body>
    <?php include 'cabecera2.php'; ?>
    </section>
    <section class="breadcrumb">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="?controller=producto">Home</a></li>
                <li class="breadcrumb-item"><a href="?controller=producto&action=carta">Carta</a></li>
                <li class="breadcrumb-item active" aria-current="page">Bebidas</li>
            </ol>
        </nav>
    </section>
    <section class="description">
        <div class="description"></div>
        <h2>BEBIDAS</h2>
        <p>
            En la Cafetería Querol, hemos creado con esmero una variedad de bebidas que se adaptan a todos los gustos y
            momentos del día. Nuestra carta de bebidas está diseñada para realzar tu experiencia de compra en Querol,
            ofreciéndote una amplia selección para satisfacer tu paladar mientras disfrutas de un merecido descanso.
            Desde aromáticos cafés hasta infusiones de té tentadoras, nuestra carta de bebidas abarca una gama de
            sabores que te cautivarán. Permítenos complacer tus sentidos y hacer que tu visita a Querol sea aún más
            especial a través de nuestra exquisita oferta de bebidas.
        </p>

    </section>
    <section class="categories">
        <div class="row">
            <div class="col-6">
                <div class="categoriesdropdown">
                    <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        CATEGORIAS
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="?controller=producto&action=bebidas">Bebidas</a></li>
                        <li><a class="dropdown-item" href="?controller=producto&action=alimentacion">Alimentación</a>
                        </li>
                        <li><a class="dropdown-item" href="?controller=producto&action=packs">Packs</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section>
    <div class="row allproducts">
            <?php
            include_once 'model/productoDAO.php';
            $categoria = 1;

            $productos = productoDAO::getProductoBebidas($categoria);

            $contador = 0;
            if ($productos && count($productos) > 0) {
                foreach ($productos as $producto) {
                    // Formatea el precio con comas en lugar de puntos
                    $precioFormateado = number_format($producto->PRECIO, 2, ',', '.');

                    ?>
                    <div class="col-12 col-md-2 mb-3 position-relative">
                        <div class="card cartaproducto">
                            <img src="<?= $producto->IMG; ?>" class="card-img-top" alt="<?= $producto -> NOMBRE_PRODUCTO ?>">
                            <div class="card-body">
                                <p class="card-title name">
                                    <?= $producto->NOMBRE_PRODUCTO; ?>
                                </p>
                                <p class="card-title description">
                                    <?= $producto->DESCRIPCION; ?>
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
                    $contador++;
                    if ($contador % 5 === 0) {
                        echo '<div class="w-100"></div>';
                    }
                }
            } else {
                echo "<p>No se encontraron productos.</p>";
            }
            ?>
        </div>

        <hr>
        <!-- Newsletter Section -->
        <div class="newsletter mt-4">
            <h3>¿Quieres recibir nuestras ofertas y novedades?</h3>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <input type="text" class="form-control" placeholder="Introduce tu e-mail para suscribirte">
                </div>
                <div class="col-md-6 col-sm-12 mt-2 mt-md-0">
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


    </section>
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