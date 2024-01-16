<!DOCTYPE html>
<html lang="en">

<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-SsDkMO9SMV3F8C3QvxZjScNB6eScB8peVp/UL6ZI3jFhAxVdfdC4vhm3ZXiU04QE"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="Style\styleadminpage.css">
  <meta charset="UTF-8">
  <link rel="icon" type="image/jpg" href="img\icons\logoQuerol.jpg">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Administrador</title>
</head>

<body>
  <header>
    <section>
      <div class="row">
        <div class="Header2 col-12 col-md-4 text-sm-center">
          <img src="img/icons/coffee.png" alt="coffee">
          <h3 class="text-sm">TOMA LO QUE QUIERAS MIENTRAS COMPRAS</h3>
        </div>
        <div class="Header2 col-12 col-md-4 text-sm-center">
          <img src="img/icons/coffee-cup.png" alt="coffee">
          <h3 class="text-sm">COME AQUI O LLEVATELO A CASA</h3>
        </div>
        <div class="Header2 col-12 col-md-4 text-sm-center">
          <img src="img/icons/cake.png" alt="cake">
          <h3 class="text-sm">SERVICIO DE COMIDA</h3>
        </div>
      </div>
    </section>
    <div class="header3">
      <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand" href="?controller=producto"><img src="img\IMGHome\logo_principal.png" alt="logo"></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="?controller=producto">HOME</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="?controller=producto&action=Carta">CARTA</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="?controller=producto&action=Reseñas">RESEÑAS</a>
              </li>
            </ul>
            <form class="d-flex" role="search">
              <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Buscar">
              <button class="btn" type="submit">Buscar</button>
            </form>
            <a class="navbar-account" href="?controller=usuario&action=redirectToPage"><img
                src="img\icons\icon-account.png" alt="logo"></a>
            <a class="navbar-cart" href="?controller=producto&action=Carrito">
              <img src="img\icons\carrito-de-compras.png" alt="logo">
              <?php
              include_once("utils/Funciones.php");
              // Llamar a la función contarProductosEnCarrito() para obtener el número de productos
              $numeroProductos = contarProductosEnCarrito();

              // Mostrar el número de productos solo si es mayor que cero
              if ($numeroProductos > 0) {
                echo '<span class="cart-count">' . $numeroProductos . '</span>';
              }
              ?>
            </a>
          </div>
        </div>
      </nav>
    </div>
    </>
  </header>
  <section class="breadcrumb">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="?controller=producto">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Admin Page</li>
      </ol>
    </nav>
  </section>
  <div class="row">
    <div class="col-md-3">
      <div class="menumyaccount" id="cssmenu">
        <h3>Mi cuenta</h3>
        <ul>
          <li><a href="?controller=usuario&action=dashboard" title="Mis Datos">Mis datos</a></li>
          <hr>
          <li><a href="?controller=usuario&action=mispedidos" title="Mis pedidos">Mis pedidos</a></li>
          <hr>
          <?php
          // Verifica si 'email' está definido en la sesión
          if (isset($_SESSION['email'])) {
            $emailUsuario = $_SESSION['email'];
            $permisoUsuario = usuarioController::obtenerPermisoUsuario($emailUsuario);
            // Muestra el enlace solo si el permiso es 0
            if ($permisoUsuario == 0) {
              echo '<li>Pagina Administrador</li><hr>';

            }
          } else {
            echo "<li>El índice 'email' no está definido en la sesión.</li>";
          }
          ?>

          <li><a href="?controller=usuario&action=CerrarSesion" title="Cerrar sesión">Cerrar sesión</a></li>
        </ul>
      </div>
    </div>


    <div class="col-md-9">
      <section class="tablaProductos">
        <h2>Listado de Productos</h2>
        <!-- Agrega la tabla con las clases de Bootstrap -->
        <a href="?controller=producto&action=crearProducto" class="btn btn-primary">Crear Producto</a>
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>ID Producto</th>
              <th>ID Categoría</th>
              <th>Nombre del Producto</th>
              <th>Descripción</th>
              <th>Precio</th>
              <th>Cantidad</th>
              <th>Imagen</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php
            // Obtener productos de la base de datos y mostrar en la tabla
            $productos = productoDAO::getAllProducto(); // Ajusta según tus necesidades
            
            foreach ($productos as $producto) {
              echo '<tr>';
              echo '<td>' . $producto->ID_PRODUCTO . '</td>';
              echo '<td>' . $producto->ID_CATEGORIA . '</td>';
              echo '<td>' . $producto->NOMBRE_PRODUCTO . '</td>';
              echo '<td>' . $producto->DESCRIPCION . '</td>';
              echo '<td>' . $producto->PRECIO . '</td>';
              echo '<td>' . $producto->CANTIDAD . '</td>';
              echo '<td>' . $producto->IMG . '</td>';
              echo '<td>
                        <a href="?controller=producto&action=eliminarProducto&id=' . $producto->ID_PRODUCTO . '" class="btn btn-primary">Eliminar</a>
                        <a href="?controller=producto&action=modificarProducto&id=' . $producto->ID_PRODUCTO . '" class="btn btn-info">Modificar</a>
                    </td>';
              echo '</tr>';
            }
            ?>
          </tbody>
        </table>
        </tbody>
        </table>
      </section>
    </div>

    </section>
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