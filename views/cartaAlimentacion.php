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
                <li class="breadcrumb-item active" aria-current="page">Alimentación</li>
            </ol>
        </nav>
    </section>
    <section class="description">
        <div class="description"></div>
        <h2>ALIMENTACIÓN</h2>
        <p>
            En la Cafetería Querol, nos esforzamos por ofrecer una selección cuidadosa de opciones gastronómicas en la
            categoría de alimentación, diseñadas para satisfacer diversos gustos y momentos del día. Hemos creado una
            carta pensada para complementar tu experiencia de compra en Querol, brindándote una variedad de delicias que
            te acompañarán en cualquier ocasión. Desde opciones saludables y nutritivas hasta tentadores manjares,
            nuestra oferta gastronómica en la categoría de alimentación está diseñada para conquistar tu paladar.
            Permítenos agasajar tus sentidos y hacer que cada visita a Querol sea aún más especial a través de nuestras
            exquisitas propuestas alimenticias.
        </p>

    </section>
    <section class="categories">
        <div class="row">
            <div class="categoriesdropdown col-2">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    CATEGORIAS
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="?controller=producto&action=bebidas">Bebidas</a></li>
                    <li><a class="dropdown-item" href="?controller=producto&action=alimentacion">Alimentación</a>
                    </li>
                    <li><a class="dropdown-item" href="?controller=producto&action=packs">Packs</a></li>
                </ul>


            </div>
            <div class="categoriesdropdown col-9">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    ORDENAR
                </button>
                <ul class="dropdown-menu">
                    <li><button class="dropdown-item" type="button">Ascendente</button></li>
                    <li><button class="dropdown-item" type="button">Descendente</button></li>
                    <li><button class="dropdown-item" type="button">Top ventas</button></li>
                </ul>
            </div>
        </div>
    </section>
    <section>
        <div class="row allproducts">
            <?php
            include_once 'model/productoDAO.php';
            $categoria = 2;

            $productos = productoDAO::getProductoAlimentacion($categoria);

            $contador = 0;
            if ($productos && count($productos) > 0) {
                foreach ($productos as $producto) {
                    ?>
                    <div class="col-2 mb-3 position-relative"> <!-- Agregamos margen inferior y posición relativa -->
                        <div class="card">
                            <img src="<?= $producto['IMG']; ?>" class="card-img-top" alt="Imagen del producto">
                            <div class="card-body">
                                <p class="card-title name">
                                    <?= $producto['NOMBRE_PRODUCTO']; ?>
                                </p>
                                <p class="card-title description">
                                    <?= $producto['DESCRIPCION']; ?>
                                </p>
                                <h2 class="card-text price">
                                    <?= $producto['PRECIO'] . "€"; ?>
                                </h2>
                                <form action="?controller=producto&action=sel" method="post">
                                    <input type="hidden" name="product_id" value="<?= $producto['ID_PRODUCTO']; ?>">
                                    <input type="hidden" name="product_name" value="<?= $producto['NOMBRE_PRODUCTO']; ?>">
                                    <input type="hidden" name="product_price" value="<?= $producto['PRECIO']; ?>">
                                    <input type="hidden" name="product_img" value="<?= $producto['IMG']; ?>">
                                    <input type="hidden" name="product_description" value="<?= $producto['DESCRIPCION']; ?>">
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
                        echo '<div class="w-100"></div>'; // Agrega un salto de línea cada 5 tarjetas
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
<?= require_once('footer.php') ?>