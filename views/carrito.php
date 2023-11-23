<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="Style/stylecarrito.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
</head>

<body>
    <div class="HeaderCarrito">
        <a href="tu_enlace_aqui">
            <img src="img\IMGHome\logo_principal.png" alt="logoQuerol">
        </a>
    </div>
    <div class="col-right-opc">
        <h2>Columna Derecha</h2>
        <p>Este es el contenido de la columna derecha.</p>
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
            session_start();

            // Verificar si hay productos en el carrito
            if (!empty($_SESSION['cart'])) {
                // Mostrar detalles de cada producto en el carrito
                foreach ($_SESSION['cart'] as $producto) {
                    ?>
                    <div class="cartProducts row">
                        <div class="col-md-2">
                            <img src="<?= isset($producto['img']) ? $producto['img'] : ''; ?>" class="card-img-top"
                                alt="Imagen del producto">
                        </div>
                        <div class="col-md-10">
                            <div class="card-body">
                                <div class="cardBodyPrice">
                                    <h5 class="card-title name col-2">
                                        <?= isset($producto['name']) ? $producto['name'] : ''; ?>
                                    </h5>
                                    <p class="description">
                                        <?= isset($producto['description']) ? $producto['description'] : ''; ?>
                                    </p>
                                    <p class="card-text price col-10 text-end">
                                        <?= isset($producto['price']) ? $producto['price'] . "€" : ''; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <?php
                }
                ?>
                <!-- Botón provisional para borrar el carrito -->
                <form action="?controller=producto&action=deleteAllCart" method="post" class="text-center">
                    <button type="submit" class="btn btn-danger">Borrar Carrito</button>
                </form>
                <?php
            } else {
                echo "<p class='text-center'>No hay productos en el carrito.</p>";
            }
            ?>


        </div>

</body>

</html>