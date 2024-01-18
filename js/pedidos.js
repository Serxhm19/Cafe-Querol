const changeRating = document.querySelectorAll('input[name=rating]');
changeRating.forEach((radio) => {
    radio.addEventListener('change', getRating);
});

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

// Esta función obtiene los valores del formulario y devuelve un objeto con esos valores
function obtenerValoresDelFormulario() {
    // Obtén los valores de los campos del formulario
    var id_pedido = document.getElementById('idPedidoResena').value;
    var id_usuario = document.getElementById('idUsuarioResena').value;
    var asunto_resena = document.getElementById('asuntoResena').value;
    var comentario_resena = document.getElementById('comentarioResena').value;
    var valoracion_resena = document.getElementById('valoracionResena').value; // Obtén el valor directamente del campo de entrada

    // Retorna un objeto con los valores obtenidos
    return {
        id_pedido: id_pedido,
        id_usuario: id_usuario,
        asunto_resena: asunto_resena,
        comentario_resena: comentario_resena,
        valoracion_resena: valoracion_resena
    };
}

// ... (Otras partes del código)

$(document).ready(function () {
    // Agrega un evento de clic al botón
    $("#btnAgregarResena").click(function () {
        // Obtiene los valores del formulario
        var valoresFormulario = obtenerValoresDelFormulario();
        console.log(valoresFormulario); // Agrega este log

        // Realiza la solicitud Fetch a tu API con datos en formato JSON
        fetch('http://workspace.com/Workspace/Cafe-Querol/controller=API&action=api', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                accion: 'add_review',
                id_pedido: valoresFormulario.id_pedido,
                id_usuario: valoresFormulario.id_usuario,
                asunto_resena: valoresFormulario.asunto_resena,
                comentario_resena: valoresFormulario.comentario_resena,
                valoracion_resena: valoresFormulario.valoracion_resena,
            }),
        })
            .then(response => {
                // Comprueba si la respuesta del servidor es exitosa (código de estado 200)
                if (!response.ok) {
                    throw new Error('Error en la solicitud. Código de estado: ' + response.status);
                }
                return response.json();
            })
            .then(data => {
                // Comprueba si la respuesta de la API indica un error
                if (data && data.error) {
                    throw new Error('Error en la API: ' + data.error);
                }

                // Maneja la respuesta de la API aquí
                console.log(data); // Agrega este log
                alert("Reseña añadida correctamente");
            })
            .catch((error) => {
                // Maneja los errores aquí
                console.error('Error:', error.message);
                alert("Error al agregar la reseña");
            });
    });
});
