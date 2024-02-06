
// para todos los radiobutton rating agregar un on change
const changeRating = document.querySelectorAll('input[name=rating]');
changeRating.forEach((radio) => {
    radio.addEventListener('change', getRating);
});

// buscar el radiobutton checked y armar el texto con el valor ( 0 - 5 )
function getRating() {
    let estrellas = document.querySelector('input[name=rating]:checked').value;
    document.getElementById("texto").innerHTML = (
        0 < estrellas ?
            estrellas + " estrella" + (1 < estrellas ? "s" : "") :
            "sin calificar"
    );
}

$(document).ready(function () {
    $('#myModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Botón que activó el modal
        var idPedido = button.data('idpedido'); // Extraer el ID desde el atributo data-idpedido
        var modal = $(this);

        // Actualizar el contenido del modal con el ID
        modal.find('#idPedidoResena').val(idPedido);
    });
});

function obtenerValoresDelFormulario() {


    // Rest of your code remains unchanged
    var id_pedido = document.getElementById('idPedidoResena').value;
    var asunto_resena = document.getElementById('asuntoResena').value;
    var comentario_resena = document.getElementById('comentarioResena').value;
    var valoracion_resena = document.querySelector('input[name=rating]:checked').value;

    return {
        "id_pedido": id_pedido,
        "asunto_resena": asunto_resena,
        "comentario_resena": comentario_resena,
        "valoracion_resena": valoracion_resena,
    };
}


$("#btnAgregarResena").click(function () {
    var valoresFormulario = obtenerValoresDelFormulario();
    console.log(valoresFormulario);

    let formData = new FormData();
    formData.append('accion', 'add_review');

    for (const [key, value] of Object.entries(valoresFormulario)) {
        formData.append(key, value);
    }

    insertarResenaApi(formData);
});

// Función para mostrar mensajes con Notie.js
function mostrarMensaje(response) {
    if (response.exists) {
        // Ya existe una reseña
        notie.alert({
            type: 'error',
            text: response.error,
            time: 3 // Duración del mensaje en segundos
        });
    } else if (response.success) {
        // Reseña añadida con éxito
        notie.alert({
            type: 'success',
            text: response.success,
            time: 3 // Duración del mensaje en segundos
        });
    } else if (response.error) {
        // Otro tipo de error
        notie.alert({
            type: 'error',
            text: response.error,
            time: 3 // Duración del mensaje en segundos
        });
    }
}

// Llama a la función al recibir la respuesta del servidor
async function insertarResenaApi(formData) {
    const url = 'http://workspace.com/Workspace/Cafe-Querol/?controller=API&action=api';

    try {
        const response = await axios.post(url, formData);
        console.log(response.data);
        mostrarMensaje(response.data); // Muestra el mensaje con Notie.js
    } catch (error) {
        console.error('Error:', error.message);
        alert("Error al agregar la reseña");
    }
}

