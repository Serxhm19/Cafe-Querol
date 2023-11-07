<div>
    <table id="productos">
        <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Imagen</th>
            <th>ID de Categoría</th>
            <th>Acciones</th>
        </tr>
        <?php
        include_once("model/productoDAO.php");
        include_once("model/producto.php");

        $allProducts = productoDAO::getAllProducto();
        foreach ($allProducts as $producto) {
            ?>
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
                    <?= $producto->CANTIDAD ?>
                </td>
                <td>
                    <?= $producto->IMG ?>
                </td>
                <td>
                    <?= $producto->ID_CATEGORIA ?>
                </td>
                <td>
                    <button onclick="editarProducto(<?= $producto->ID ?>)">Editar</button>
                    <button onclick="eliminarProducto(<?= $producto->ID ?>)">Eliminar</button>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>