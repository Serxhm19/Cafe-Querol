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