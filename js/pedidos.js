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

    // opcionalmente agregar un ajax para guardar el rating
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





$(document).ready(function () {

    // Agrega un evento de clic al botón
    $("#btnAgregarResena").click(function () {
        // Obtiene los valores del formulario
        var valoresFormulario = obtenerValoresDelFormulario();

        // Realiza la solicitud Fetch a tu API
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
            .then(response => response.json())
            .then(data => {
                // Maneja la respuesta de la API aquí
                console.log(data);
                alert("Reseña añadida correctamente");
            })
            .catch((error) => {
                // Maneja los errores aquí
                console.error('Error:', error);
                alert("Error al agregar la reseña");
            });
    });

    // Función para obtener valores del formulario
    function obtenerValoresDelFormulario() {
        // Reemplaza esto con la lógica real para obtener valores del formulario
        return {
            id_pedido: obtenerValorDelFormulario('#id_pedido'),
            id_usuario: obtenerValorDelFormulario('#id_usuario'),
            asunto_resena: obtenerValorDelFormulario('#asunto_resena'),
            comentario_resena: obtenerValorDelFormulario('#comentario_resena'),
            valoracion_resena: obtenerValorDelFormulario('input[name=valoracion_resena]:checked'),
        };
    }

    // Función para obtener valores del formulario (reemplázala con tu lógica real)
    function obtenerValorDelFormulario(selector) {
        // Reemplaza esto con la lógica real para obtener valores del formulario
        return $(selector).val();
    }
});
