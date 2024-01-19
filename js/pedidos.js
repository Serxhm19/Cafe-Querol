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

function obtenerValoresDelFormulario() {

    var id_pedido = document.getElementById('idPedidoResena').value;
    var id_usuario = 13;
    var asunto_resena = document.getElementById('asuntoResena').value;
    var comentario_resena = document.getElementById('comentarioResena').value;
    var valoracion_resena = document.getElementById('valoracionResena').value; 

    return {
        "id_pedido": id_pedido,
        "id_usuario": id_usuario,
        "asunto_resena": asunto_resena,
        "comentario_resena": comentario_resena,
        "valoracion_resena": valoracion_resena
    };
}

$(document).ready(function () {
    $("#btnAgregarResena").click(function () {
        var valoresFormulario = obtenerValoresDelFormulario();
        console.log(valoresFormulario);
        fetch('http://workspace.com/Workspace/Cafe-Querol/?controller=API&action=api', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json; charset=utf-8',
            },
            body: JSON.stringify({
                accion: 'add_review',
                valoresFormulario,
            }),
        })
            .then(data => data.json())
            .catch((error) => {
                console.error('Error:', error.message);
                alert("Error al agregar la reseña");
            });
    });
});
