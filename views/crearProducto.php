<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Producto</title>
</head>

<body>
    <h2>Crear Producto</h2>
    <?php
    // Verifica si hay errores
    if (!empty($errors)) {
        echo '<div class="alert alert-danger" role="alert">';
        foreach ($errors as $error) {
            echo $error . '<br>';
        }
        echo '</div>';
    }
    ?>
    <form method="post" action="?controller=producto&action=procesarCrearProducto">
        <label for="idCategoria">ID Categoría:</label>
        <input type="number" name="idCategoria" min="1" max="3" required>

        <label for="nombreProducto">Nombre del Producto:</label>
        <input type="text" name="nombreProducto" required>

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" required></textarea>

        <label for="precio">Precio:</label>
        <input type="number" name="precio" required>

        <label for="cantidad">Cantidad:</label>
        <input type="number" name="cantidad" required>

        <label for="img">URL de la Imagen:</label>
        <input type="text" name="img" required>

        <input type="submit" value="Crear">
    </form>
</body>

</html>