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
  <link rel="icon" type="image/jpg" href="img\icons\logoQuerol.jpg">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Café Querol | Tu cafeteria de confianza</title>
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
              <a class="navbar-account" href="?controller=usuario&action=redirectToPage"><img
                  src="img\icons\icon-account.png" alt="logo"></a>
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
  <section class="breadcrumb">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="?controller=producto">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
      </ol>
    </nav>
  </section>
  <div class="row">
    <div class="col-md-3">
      <div class="menumyaccount" id="cssmenu">
        <h3>Mi cuenta</h3>
        <ul>
          <li>Mis datos</li>
          <hr>
          <li><a href="?controller=usuario&action=mispedidos" title="Mis Pedidos">Mis Pedidos</a></li>
          <hr>
          <?php
          // Verifica si 'email' está definido en la sesión
          if (isset($_SESSION['email'])) {
            $emailUsuario = $_SESSION['email'];
            $permisoUsuario = usuarioController::obtenerPermisoUsuario($emailUsuario);
            // Muestra el enlace solo si el permiso es 0
            if ($permisoUsuario == 0) {
              echo '<li><a href="?controller=usuario&action=adminPage" title="Pagina Administrador">Pagina Administrador</a></li><hr>';

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
      <div class="formulario">
        <h4>Cambio de dirección del correo electrónico</h4>
        <p>Si deseas cambiar tu dirección de correo electrónico, completa el siguiente formulario. Este proceso te
          permitirá conservar el historial de tu cuenta y recibir nuestros correos en tu nueva dirección.</p>

        <p2>Tu email actual es:
          <span class="redmail strong">
            <?php echo $_SESSION['email']; ?>
          </span>
        </p2>

        <div class="blockemail">
          <form action="?controller=usuario&action=ActualizarDatos" method="post" class="std">
            <fieldset>
              <div class="mb-3">
                <input type="password" class="form-control" id="passwd" name="passwd" placeholder="Contraseña actual">
              </div>
              <div class="mb-3">
                <input type="email" class="form-control" id="email" name="email" value=""
                  placeholder="Nuevo correo electrónico">
              </div>
              <div class="mb-3">
                <input type="email" class="form-control" id="email2" name="email2" value=""
                  placeholder="Confirmar correo electrónico">
              </div>
              <div class="mb-3">
                <span class="infoobligatorios"> * Campos obligatorios <input type="hidden" name="tipo" value="email">
                </span>
              </div>
              <div class="mb-3">
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
                <input type="password" class="form-control" id="passwd" name="passwd" placeholder="Contraseña actual:">
              </div>
              <div class="mb-3">
                <input type="password" class="form-control" id="passwordnew" name="passwordnew" value=""
                  placeholder="Nueva contraseña">
              </div>
              <div class="mb-3">
                <input type="password" class="form-control" id="passwordnew2" name="passwordnew2" value=""
                  placeholder="Confirmar nueva contraseña">
              </div>
              <div class="mb-3">
                <span class="infoobligatorios"> * Campos obligatorios <input type="hidden" name="tipo" value="email">
                </span>
              </div>
              <div class="mb-3">
                <button type="submit" class="btn btn-primary">Actualizar Contraseña</button>
              </div>
            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </div>

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