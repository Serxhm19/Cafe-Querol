<!DOCTYPE html>
<html lang="en">

<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="Style\stylereseñas.css">
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
  <hr>
  <section>
    <!-- Agrega menú desplegable de Bootstrap para filtrar por valoración -->
    <div class="rating-dropdown">
      <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        Filtrar por valoración
      </button>
      <ul class="dropdown-menu">
        <li>
          <input type="checkbox" class="form-check-input rating-checkbox" id="1">
          <label class="form-check-label" for="1">1 estrella</label>
        </li>
        <li>
          <input type="checkbox" class="form-check-input rating-checkbox" id="2">
          <label class="form-check-label" for="2">2 estrellas</label>
        </li>
        <li>
          <input type="checkbox" class="form-check-input rating-checkbox" id="3">
          <label class="form-check-label" for="3">3 estrellas</label>
        </li>
        <li>
          <input type="checkbox" class="form-check-input rating-checkbox" id="4">
          <label class="form-check-label" for="4">4 estrellas</label>
        </li>
        <li>
          <input type="checkbox" class="form-check-input rating-checkbox" id="5">
          <label class="form-check-label" for="5">5 estrellas</label>
        </li>
      </ul>
    </div>

    <!-- Agrega otro menú desplegable para filtrar por orden ascendente o descendente -->
    <div class="order-dropdown">
      <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        Filtrar por orden
      </button>
      <ul class="dropdown-menu">
        <li>
          <input type="radio" class="form-check-input order-radio" name="order" id="ascendente" value="ascendente">
          <label class="form-check-label" for="ascendente">Ascendente</label>
        </li>
        <li>
          <input type="radio" class="form-check-input order-radio" name="order" id="descendente" value="descendente">
          <label class="form-check-label" for="descendente">Descendente</label>
        </li>
      </ul>
    </div>
  </section>

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
        const response = await fetch('https://workspace.com/Workspace/Cafe-Querol/?controller=API&action=api', {
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

          // Create star rating HTML based on the rating value
          var starsHTML = '';
          for (let i = 0; i < formData.VALORACION_RESEÑA; i++) {
            starsHTML += '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="star"><path d="M12 2l3.09 6.31L22 9.24l-5.62 5.46 1.33 7.77L12 18.77l-6.71 3.7 1.33-7.77L2 9.24l6.91-.93L12 2z"/></svg>';
          }

          // Populate the card with data including star rating HTML
          card.innerHTML = `
          <h2>${formData.ASUNTO_RESEÑA}</h2>
          <p data-rating="${formData.VALORACION_RESEÑA}">${starsHTML}</p>
          <p>${formData.COMENTARIO_RESEÑA}</p>
          <p>${formData.FECHA_RESEÑA}</p>
          <p>${formData.EMAIL_USUARIO}</p>
        `;

          // Append the card to the cards container
          var cardsContainer = document.getElementById('cards-container');
          cardsContainer.appendChild(card);
        });

        // Add event listener to checkbox for filtering
        var ratingCheckboxes = document.querySelectorAll('.rating-checkbox');
        ratingCheckboxes.forEach(function (checkbox) {
          checkbox.addEventListener('change', function () {
            filterReviews();
          });
        });

        // Add event listener to radio buttons for ordering
        var orderRadios = document.querySelectorAll('.order-radio');
        orderRadios.forEach(function (radio) {
          radio.addEventListener('change', function () {
            filterReviews();
          });
        });

      } catch (error) {
        console.error('Error:', error.message);
      }
    }

    // Function to filter reviews based on selected ratings and order
    function filterReviews() {
      var selectedRatings = [];
      var checkedCheckboxes = document.querySelectorAll('.rating-checkbox:checked');
      checkedCheckboxes.forEach(function (checkbox) {
        selectedRatings.push(checkbox.id);
      });

      var orderValue = '';
      var checkedRadio = document.querySelector('.order-radio:checked');
      if (checkedRadio) {
        orderValue = checkedRadio.value;
      }

      var cards = document.querySelectorAll('.card');
      cards.forEach(function (card) {
        var cardRating = parseInt(card.querySelector('p[data-rating]').getAttribute('data-rating'));
        if (selectedRatings.length === 0 || selectedRatings.includes(cardRating.toString())) {
          card.style.display = 'block';
        } else {
          card.style.display = 'none';
        }
      });

      if (orderValue === 'ascendente') {
        sortCardsByRating('ascendente');
      } else if (orderValue === 'descendente') {
        sortCardsByRating('descendente');
      }
    }

    // Function to sort cards by rating
    function sortCardsByRating(order) {
      var cardsContainer = document.getElementById('cards-container');
      var cards = Array.from(cardsContainer.children);

      cards.sort(function (a, b) {
        var ratingA = parseInt(a.querySelector('p[data-rating]').getAttribute('data-rating'));
        var ratingB = parseInt(b.querySelector('p[data-rating]').getAttribute('data-rating'));

        if (order === 'ascendente') {
          return ratingA - ratingB;
        } else if (order === 'descendente') {
          return ratingB - ratingA;
        }
      });

      // Vaciar el contenedor de tarjetas y volver a añadir las tarjetas ordenadas
      cardsContainer.innerHTML = '';
      cards.forEach(function (card) {
        cardsContainer.appendChild(card);
      });
    }
  </script>

</body>

</html>