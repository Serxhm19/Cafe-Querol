<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Producto</title>
</head>

<body>
    <h2>Modificar Producto</h2>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Modificar Producto</title>
    </head>

    <body>
        <h2>Modificar Producto</h2>
        <?php
        // Verifica si se han pasado detalles del producto
        if (!empty($detallesProducto)) {
            // Mostrar el formulario de modificación
            echo '<form method="post" action="?controller=producto&action=procesarModificarProducto">';

            // Utiliza la notación de flecha para acceder a las propiedades del objeto
            echo '<input type="hidden" name="idProducto" value="' . $detallesProducto->ID_PRODUCTO . '">';

            echo '<label for="idCategoria">ID Categoría:</label>';
            echo '<input type="number" name="idCategoria" value="' . $detallesProducto->ID_CATEGORIA . '" min="1" max="3">';

            echo '<label for="nombreProducto">Nombre del Producto:</label>';
            echo '<input type="text" name="nombreProducto" value="' . $detallesProducto->NOMBRE_PRODUCTO . '" required>';

            echo '<label for="descripcion">Descripción:</label>';
            echo '<textarea name="descripcion" required>' . $detallesProducto->DESCRIPCION . '</textarea>';

            echo '<label for="precio">Precio:</label>';
            echo '<input type="number" name="precio" value="' . $detallesProducto->PRECIO . '" required>';

            echo '<label for="cantidad">Cantidad:</label>';
            echo '<input type="number" name="cantidad" value="' . $detallesProducto->CANTIDAD . '" required>';

            echo '<label for="img">URL de la Imagen:</label>';
            echo '<input type="text" name="img" value="' . $detallesProducto->IMG . '" required>';

            // Botón de modificar
            echo '<input type="submit" value="Modificar">';

            echo '</form>';
        } else {
            echo 'Error: No se encontraron detalles del producto.';
        }
        ?>


    </body>

    </html>


