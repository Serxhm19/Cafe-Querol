<?php
 function contarProductosEnCarrito()
 {
     session_start();
 
     // Inicializar el contador
     $contador = 0;
 
     // Verificar si hay productos en el carrito
     if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
         // Iterar sobre los productos y sumar las cantidades
         foreach ($_SESSION['cart'] as $producto) {
             if (isset($producto['quantity']) && is_numeric($producto['quantity'])) {
                 $contador += (int)$producto['quantity'];
             }
         }
     } else {
        
          }
 
     return $contador;
 }
 

 function contarProductosEnCarrito2()
 {
     session_start();
 
     // Inicializar el contador
     $contador = 0;
 
     // Verificar si hay productos en el carrito
     if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
         // Iterar sobre los productos y sumar las cantidades
         foreach ($_SESSION['cart'] as $producto) {
             if (isset($producto['quantity']) && is_numeric($producto['quantity'])) {
                 $contador += (int)$producto['quantity'];
             }
         }
     } else {
        echo "<p class='text-center'>No hay productos en el carrito.</p>";
     }
     return $contador;
 }
 
 function sumarPrecioPorId($productoId)
 {
    session_start();
     // Inicializar la suma del precio
     $sumaPrecio = 0;
 
     // Verificar si hay productos en el carrito
     if (!empty($_SESSION['cart'])) {
         // Sumar el precio de los productos con el ID especificado
         foreach ($_SESSION['cart'] as $producto) {
             if (isset($producto['id']) && $producto['id'] == $productoId) {
                 $sumaPrecio += $producto['price'];
             }
         }
     }
 
     return $sumaPrecio;
 }
 
 function calcularTotalProducto($precio, $cantidad)
 {
     return $precio * $cantidad;
 }
 
 function calcularPrecioTotal($productos)
 {
     // Inicializar el precio total del carrito
     $precioTotalCarrito = 0;
 
     // Calcular el total de los productos en el carrito
     foreach ($productos as $producto) {
         $precioTotalCarrito += calcularTotalProducto(
             isset($producto['price']) ? $producto['price'] : 0,
             isset($producto['quantity']) ? $producto['quantity'] : 0
         );
     }
 
     // Verificar si el precio total supera los 15€ para envío gratuito
     $precioEnvio = ($precioTotalCarrito > 15) ? 0 : 4.99;
 
     // Calcular el precio total sumando el envío
     $precioTotal = $precioTotalCarrito + $precioEnvio;
 
     return [
         'precioTotalCarrito' => $precioTotalCarrito,
         'precioEnvio' => $precioEnvio,
         'precioTotal' => $precioTotal,
     ];
 }


?>