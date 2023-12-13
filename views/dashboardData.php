<!DOCTYPE html>
<html lang="en">

<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-SsDkMO9SMV3F8C3QvxZjScNB6eScB8peVp/UL6ZI3jFhAxVdfdC4vhm3ZXiU04QE"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="Style/stylehomepage.css">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Header</title>
</head>

<body>
  <header>
    <section>
      <div class="row">
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
        <li>Mis datos
          <ul class="submyaccount">
            <li><i class="icon"></i><a href="https://www.querol.net/es/mi-cuenta" title="Datos acceso">Datos de
                acceso</a></li>
            <li><a href="https://www.querol.net/es/mi-cuenta" title="Datos acceso"><i class="icon"></i></a><a
                href="https://www.querol.net/es/identidad" title="Datos Personales">Datos personales</a></li>
          </ul>
        </li>
        <li><a href="https://www.querol.net/es/historial-de-pedidos" title="Mis pedidos">Mis pedidos</a></li>
        <li><a href="?controller=usuario&action=CerrarSesion" title="Cerrar sesión">Cerrar sesión</a></li>
      </ul>
    </div>
  </div>
  <div class="col-md-9">
    <div class="col-md-9">
      <h3>Datos personales</h3>
      <h4>Cambio de datos personales</h4>
      <p>Podrás acceder y modificar tus datos prsonales (nombre, dirección de facturación, teléfono...) para facilitar
        tus futuras compras y notificarnos cualquier cambio en tus datos de contacto.</p>


      <form action="https://www.querol.net/es/identidad" method="post" class="std alinear">
        <fieldset>
          <div class="required form-group">
            <input placeholder="Nombre *" class="is_required validate form-control" type="text" id="firstname"
              name="firstname" value="Sergi">
          </div>

          <div class="required form-group">

            <input placeholder="Apellido *" class="is_required validate form-control" type="text" name="lastname"
              id="lastname" value="Hernández">
          </div>

          <div class="clearfix">

            <div class="radio-inline">
              <label for="id_gender1" class="top">
                Hombre
                <div class="radio" id="uniform-id_gender1"><span class="checked"><input type="radio" name="id_gender"
                      id="id_gender1" value="1" checked="checked"></span></div>
              </label>
            </div>
            <div class="radio-inline">
              <label for="id_gender2" class="top">
                Mujer
                <div class="radio" id="uniform-id_gender2"><span><input type="radio" name="id_gender" id="id_gender2"
                      value="2"></span></div>
              </label>

              <div class="clear"></div>

              <div class="form-group" style="clear: both;float: right;">
                <span class="camposobligatorios">* Campos obligatorios</span>
                <button type="submit" name="submitIdentity" class="btn btn-default button button-medium">
                  <span>Actualizar los datos personales</span>
                </button>
              </div>

        </fieldset>
      </form> <!-- .std -->

    </div>
</body>

</html>