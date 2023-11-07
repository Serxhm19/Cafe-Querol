<form action=<?=url. 'controller/producto&action=editProduct'?> method='post'>
    <input type="hidden" name="id" value=<?= $product->getPRODUCTO_ID()?>>
    <input name="idDis" disabled value=<?= $product->getPRODUCTO_ID()?>>
    <input type="text" name="nombre" value=<?= $product->getNOMBRE_PRODUCTO()?>>
    <button type="submit" name="edit">Editar</button>
</form>