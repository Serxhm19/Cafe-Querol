<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="Style/stylecarta.css">
    <link rel="icon" type="image/jpg" href="img\icons\logoQuerol.jpg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> Café Querol | Tu cafeteria de confianza </title>
</head>

<body>
    <?php include 'cabecera2.php'; ?>
    </section>
    <section class="breadcrumb">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="?controller=producto">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Carta</li>
            </ol>
        </nav>
    </section>
    <section class="description">
        <div class="description d-none d-md-block"></div>
        <h2>CARTA</h2>
        <p class="d-none d-md-block">
            En la Cafetería Querol, hemos elaborado cuidadosamente una selección de delicias culinarias que se adaptan a
            todos los gustos y momentos del día. Nuestra carta ha sido diseñada para complementar tu experiencia de
            compra en Querol, brindándote una amplia variedad de opciones para satisfacer tu paladar mientras disfrutas
            de un merecido descanso. Desde aromáticos cafés y tés hasta tentadoras opciones de bocadillos, dulces, etc.
            Nuestra carta está repleta de sabores que te conquistarán. Permítenos deleitar tus sentidos y hacer que tu
            visita a Querol sea aún más especial a través de nuestra exquisita oferta gastronómica.
        </p>
    </section>
    <div class="col-6">
        <div class="categoriesdropdown">
            <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                CATEGORIAS
            </button>
            <ul class="dropdown-menu">
                <li><input type="checkbox" class="category-checkbox" id="bebidas"> <label for="bebidas">Bebidas</label>
                </li>
                <li><input type="checkbox" class="category-checkbox" id="alimentacion"> <label
                        for="alimentacion">Alimentación</label></li>
                <li><input type="checkbox" class="category-checkbox" id="packs"> <label for="packs">Packs</label></li>
            </ul>
        </div>
    </div>


    <section>
        <div class="row allproducts">
            <?php
            $productos = productoDAO::getAllProducto();

            $contador = 0;
            if ($productos && count($productos) > 0) {
                foreach ($productos as $producto) {
                    $precioFormateado = number_format($producto->PRECIO, 2, ',', '.');
                    ?>
                    <div class="col-12 col-md-2 mb-3 position-relative" data-categories="<?= $categorias ?>">
                        <div class="card cartaproducto">
                            <img src="<?= $producto->IMG; ?>" class="card-img-top" alt="<?= $producto->NOMBRE_PRODUCTO ?>">
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
        <!-- Newsletter y Checkbox Section -->
        <div class="newsletter mt-4">
            <h3>¿Quieres recibir nuestras ofertas y novedades?</h3>
            <div class="row">
                <div class="col-12 col-md-6">
                    <input type="text" class="form-control" placeholder="Introduce tu e-mail para suscribirte">
                </div>
                <div class="col-12 col-md-6 mt-2 mt-md-0">
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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            // Manejar el cambio en los checkboxes
            $('.category-checkbox').change(function () {
                filterProducts();
            });

            function filterProducts() {
                // Obtener categorías seleccionadas
                var selectedCategories = [];
                $('.category-checkbox:checked').each(function () {
                    selectedCategories.push($(this).attr('id'));
                });

                // Mostrar u ocultar productos según las categorías seleccionadas
                $('.allproducts .col-12').each(function () {
                    var productCategories = $(this).find('.category').data('categories').split(',');

                    if (selectedCategories.length === 0 || containsAny(productCategories, selectedCategories)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            }

            // Función auxiliar para verificar si un array contiene algún elemento de otro array
            function containsAny(source, target) {
                for (var i = 0; i < source.length; i++) {
                    if (target.indexOf(source[i]) >= 0) {
                        return true;
                    }
                }
                return false;
            }

            // Inicializar el filtro al cargar la página
            filterProducts();
        });
    </script>

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