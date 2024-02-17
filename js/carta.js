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
            url: 'https://sergihernandez.bernat2024.es/?controller=API&action=api',
            type: 'POST',
            data: {
                accion: 'get_products'
            },
            dataType: 'json',
            success: function (response) {
                if (response && response.length > 0) {
                    var productsHtml = '';
                    var contador = 0; // Agregar la variable contador y establecer su valor inicial
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

                        contador++;
                        if (contador % 5 === 0) {
                            productsHtml += '<div class="w-100"></div>'; // Agregar la nueva línea cada 5 productos
                        }
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