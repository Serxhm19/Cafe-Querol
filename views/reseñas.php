<!DOCTYPE html>
<html lang="en">

<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="Style\stylehomepage.css">
  <link rel="icon" type="image/jpg" href="img\icons\logoQuerol.jpg">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Café Querol | Tu cafeteria de confianza</title>
</head>

<header>
  <div id="Header1">
    <h2>Café Querol | Tu cafeteria de confianza</h2>
  </div>
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

  <section>
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
  </section>
</header>

<body>

<h1 class="titulo"> RESEÑAS </h1>
<!-- <div class="container"-->
  <!-- Add this to your HTML where you want to display the cards -->
  <div id="cards-container"></div>

  <script>
    window.addEventListener("load", function () {
      insertarApi();
    });

    async function insertarApi() {
      const formData = new FormData();
      formData.append('accion', 'get_reviews');

      try {
        const response = await fetch('http://workspace.com/Workspace/Cafe-Querol/?controller=API&action=api', {
          method: 'POST',
          body: formData,
        });

        if (!response.ok) {
          throw new Error("Error " + response.status + ": " + response.statusText);
        }

        const data = await response.json();
        console.log(data);

        // Assuming 'data' is an array of form data objects
        data.forEach((formData) => {
          // Create a card element
          var card = document.createElement('div');
          card.className = 'card';

          // Populate the card with data
          card.innerHTML = `
                    <h2>ID Reseña: ${formData.ID_RESEÑA}</h2>
                    <p>ID Pedido: ${formData.ID_PEDIDO}</p>
                    <p>Asunto: ${formData.ASUNTO_RESEÑA}</p>
                    <p>Comentario: ${formData.COMENTARIO_RESEÑA}</p>
                    <p>Fecha: ${formData.FECHA_RESEÑA}</p>
                    <p>Valoración: ${formData.VALORACION_RESEÑA}</p>
                `;

          // Append the card to a container in your HTML
          var cardsContainer = document.getElementById('cards-container');
          cardsContainer.appendChild(card);
        });
      } catch (error) {
        console.error('Error:', error.message);
      }
    }
  </script>


</body>

</html>