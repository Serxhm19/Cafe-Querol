<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <stylesheet name="" href="Style/stylecabecera.css">
    <title>Document</title>
</head>
<body>
    <div>
    <table id="productos">
        <tr>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Precio</th>
        </tr>
        <?php
        include_once("model/productoDAO.php");
        include_once("model/producto.php");

        $allProducts = productoDAO::getAllProducto();
        foreach ($allProducts as $producto) {
            ?>
            <table>
                <tr>
                    <td>
                        <?= $producto->NOMBRE_PRODUCTO ?>
                    </td>
                    <td>
                        <?= $producto->DESCRIPCION ?>
                    </td>
                    <td>
                        <?= $producto->PRECIO ?>
                    </td>
                    <td>
                        <button onclick="editarProducto(<?= $producto->ID ?>)">Editar</button>
                    </td>
                    <td>
                        <button onclick="eliminarProducto(<?= $producto->ID ?>)">Eliminar</button>
                    </td>
                </tr>
            </table>
            <?php
        }
        ?>
    </table>
    </div>
</body>
</html>