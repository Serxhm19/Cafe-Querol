<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="Style/stylecarta.css">
    <link rel="icon" type="image/jpg" href="img\icons\logoQuerol.jpg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Café Querol | Tu cafetería de confianza</title>
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
                <li><input type="checkbox" class="category-checkbox" id="1"> <label for="1">Bebidas</label></li>
                <li><input type="checkbox" class="category-checkbox" id="2"> <label for="2">Alimentación</label></li>
                <li><input type="checkbox" class="category-checkbox" id="3"> <label for="3">Packs</label></li>
            </ul>
        </div>
    </div>


    <section>
        <div class="row allproducts" id="product-container">
            <!-- Los productos se cargarán aquí -->
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            // Llama a la función para obtener los productos al cargar la página
            getProducts();

            // Manejar el cambio en los checkboxes
            $('.category-checkbox').change(function () {
                filterProducts();
            });

            function filterProducts() {
                var selectedCategories = [];

                // Obtener las categorías seleccionadas
                $('.category-checkbox:checked').each(function () {
                    selectedCategories.push($(this).attr('id'));
                });

                // Mostrar u ocultar productos según las categorías seleccionadas
                $('.allproducts .col-12').each(function () {
                    var productCategories = $(this).data('categories').toString();

                    if (selectedCategories.length === 0 || containsAny(productCategories.split(','), selectedCategories)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            }

            function getProducts() {
                $.ajax({
                    url: 'http://workspace.com/Workspace/Cafe-Querol/?controller=API&action=api',
                    type: 'POST',
                    data: {
                        accion: 'get_products'
                    },
                    dataType: 'json',
                    success: function (response) {
                        if (response && response.length > 0) {
                            var productsHtml = '';
                            $.each(response, function (index, product) {
                                var priceFormatted = parseFloat(product.PRECIO).toFixed(2);
                                productsHtml += `
                            <div class="col-12 col-md-2 mb-3 position-relative" data-categories="${product.ID_CATEGORIA}">
                                <div class="card cartaproducto">
                                    <img src="${product.IMG}" class="card-img-top" alt="${product.NOMBRE_PRODUCTO}">
                                    <div class="card-body">
                                        <p class="card-title name">${product.NOMBRE_PRODUCTO}</p>
                                        <p class="card-title description">${product.DESCRIPCION}</p>
                                        <h2 class="card-text price">${priceFormatted} €</h2>
                                        <form action="?controller=producto&action=sel" method="post">
                                            <input type="hidden" name="product_id" value="${product.ID_PRODUCTO}">
                                            <input type="hidden" name="product_name" value="${product.NOMBRE_PRODUCTO}">
                                            <input type="hidden" name="product_price" value="${priceFormatted}">
                                            <input type="hidden" name="product_img" value="${product.IMG}">
                                            <input type="hidden" name="product_description" value="${product.DESCRIPCION}">
                                            <button type="submit" class="btn-hover add-to-cart-btn">Añadir al Carrito</button>
                                        </form>
                                    </div>
                                </div>
                            </div>`;
                            });

                            $('#product-container').html(productsHtml);
                        } else {
                            $('#product-container').html('<p>No se encontraron productos.</p>');
                        }
                    },
                    error: function () {
                        $('#product-container').html('<p>Ocurrió un error al cargar los productos.</p>');
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

</html>


