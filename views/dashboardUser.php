<!DOCTYPE html>
<html lang="en">

<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-SsDkMO9SMV3F8C3QvxZjScNB6eScB8peVp/UL6ZI3jFhAxVdfdC4vhm3ZXiU04QE"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="Style\styledashboard.css">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Header</title>
</head>

<body>
  <header>
    <section class="row">
      <div class="Header2 col-4">
        <img src="img/icons/coffee.png" alt="coffee">
        <h3>TOMA LO QUE QUIERAS MIENTRAS COMPRAS</h3>
      </div>
      <div class="Header2 col-4">
        <img src="img/icons/coffee-cup.png" alt="coffee">
        <h3>COME AQUI O LLEVATELO A CASA</h3>
      </div>
      <div class="Header2 col-4">
        <img src="img/icons/cake.png" alt="cake">
        <h3>SERVICIO DE COMIDA</h3>
      </div>
    </section>

    <section>
      <div class="header3">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
          <div class="container-fluid">
            <a class="navbar-brand" href="?controller=producto"><img src="img/IMGHome/logo_principal.png"
                alt="logo"></a>
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
              </ul>
              <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Buscar">
                <button class="btn" type="submit">Buscar</button>
              </form>
              <a class="navbar-account" href="?controller=producto"><img src="img/icons/icon-account.png"
                  alt="logo"></a>
              <a class="navbar-cart" href="?controller=producto&action=Carrito">
                <img src="img/icons/carrito-de-compras.png" alt="logo">
                <?php
                include_once("utils/Funciones.php");
                $numeroProductos = contarProductosEnCarrito();
                if ($numeroProductos > 0) {
                  echo '<span class="cart-count">' . $numeroProductos . '</span>';
                }
                ?>
              </a>
            </div>
          </div>
        </nav>
      </div>
    </section>
  </header>

  <div class="col-md-3">
    <div class="menumyaccount" id="cssmenu">
      <h3>Mi cuenta</h3>
      <ul>
        <li>Mis datos</li>
        <li><a href="?controller=usuario&action=mispedidos" title="Mis Pedidos">Mis Pedidos</a></li>
        <?php
        // Verifica si 'email' está definido en la sesión
        if (isset($_SESSION['email'])) {
          $emailUsuario = $_SESSION['email'];
          $permisoUsuario = usuarioController::obtenerPermisoUsuario($emailUsuario);
          // Muestra el enlace solo si el permiso es 0
          if ($permisoUsuario == 0) {
            echo '<li><a href="?controller=usuario&action=adminPage" title="Pagina Administrador">Pagina Administrador</a></li>';
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
    <h3>Datos de acceso</h3>

    <h4>Cambio de dirección del correo electrónico</h4>
    <p>Si deseas cambiar tu dirección de correo electrónico, completa el siguiente formulario. Este proceso te
      permitirá conservar el historial de tu cuenta y recibir nuestros correos en tu nueva dirección.</p>

    <p><strong>Tu email actual es:</strong>
      <span class="redmail strong">
        <?php echo $_SESSION['email'];?>
      </span>
    </p>

    <div class="blockemail">
      <form action="?controller=usuario&action=ActualizarDatos" method="post" class="std">
        <fieldset>
          <div class="mb-3">
            <label for="passwd">Contraseña actual:</label>
            <input type="password" class="form-control" id="passwd" name="passwd">
          </div>
          <div class="mb-3">
            <label for="email">Nuevo correo electrónico:</label>
            <input type="email" class="form-control" id="email" name="email" value="">
          </div>
          <div class="mb-3">
            <label for="email2">Confirmar correo electrónico:</label>
            <input type="email" class="form-control" id="email2" name="email2" value="">
          </div>
          <div class="mb-3">
            <span class="infoobligatorios"> * Campos obligatorios <input type="hidden" name="tipo" value="email">
            </span>
            <button type="submit" class="btn btn-primary">Actualizar Email</button>
          </div>
        </fieldset>
      </form>
    </div>

    <h4>Cambio de contraseña</h4>
    <p>Si deseas cambiar la contraseña de acceso a tu cuenta, proporciona la siguiente información.</p>

    <div class="blockemail">
      <form action="?controller=usuario&action=ActualizarContrasena" method="post" class="std">
        <fieldset>
          <div class="mb-3">
            <label for="passwd">Contraseña actual:</label>
            <input type="password" class="form-control" id="passwd" name="passwd">
          </div>
          <div class="mb-3">
            <label for="passwordnew">Nueva contraseña:</label>
            <input type="password" class="form-control" id="passwordnew" name="passwordnew" value="">
          </div>
          <div class="mb-3">
            <label for="passwordnew2">Confirmar nueva contraseña:</label>
            <input type="password" class="form-control" id="passwordnew2" name="passwordnew2" value="">
          </div>
          <div class="mb-3">
            <span class="infoobligatorios"> * Campos obligatorios <input type="hidden" name="tipo" value="password">
            </span>
            <button type="submit" class="btn btn-primary">Actualizar Contraseña</button>
          </div>
        </fieldset>
      </form>
    </div>
  </div>

</body>

</html>