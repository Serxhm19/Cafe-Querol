document.addEventListener('DOMContentLoaded', (event) => {
    console.log('El DOM ha sido cargado');

    // para todos los radiobutton rating agregar un on change
    const changeRating = document.querySelectorAll('input[name=rating]');
    changeRating.forEach((radio) => {
        radio.addEventListener('change', getRating);
    });

    // buscar el radiobutton checked y armar el texto con el valor ( 0 - 5 )
    function getRating() {
        let estrellas = document.querySelector('input[name=rating]:checked').value;
        console.log('Estrellas seleccionadas:', estrellas);
        document.getElementById("texto").innerHTML = (
            0 < estrellas ?
                estrellas + " estrella" + (1 < estrellas ? "s" : "") :
                "sin calificar"
        );
    }

    function obtenerValoresDelFormulario() {
        var id_pedido = document.getElementById('idPedidoResena').value;
        var asunto_resena = document.getElementById('asuntoResena').value;
        var comentario_resena = document.getElementById('comentarioResena').value;
        var valoracion_resena = document.querySelector('input[name=rating]:checked').value;

        console.log('Valores del formulario:', {
            id_pedido: id_pedido,
            asunto_resena: asunto_resena,
            comentario_resena: comentario_resena,
            valoracion_resena: valoracion_resena,
        });

        return {
            "id_pedido": id_pedido,
            "asunto_resena": asunto_resena,
            "comentario_resena": comentario_resena,
            "valoracion_resena": valoracion_resena,
        };
    }

    document.getElementById("btnAgregarResena").addEventListener("click", async function () {
        console.log('Botón de agregar reseña clickeado');

        var valoresFormulario = obtenerValoresDelFormulario();

        let formData = new FormData();
        formData.append('accion', 'add_review');

        for (const [key, value] of Object.entries(valoresFormulario)) {
            formData.append(key, value);
        }

        const response = await insertarResenaApi(formData);

        if (response.error) {
            console.warn('Ya existe una reseña para este pedido');
            notie.alert({ type: 3, text: 'Ya existe una reseña para este pedido', time: 3 });
        } else {
            console.log('Reseña agregada correctamente');
            notie.alert({ type: 1, text: 'Reseña agregada correctamente', time: 3 });
        }
        
    });

    async function insertarResenaApi(formData) {
        console.log('Enviando solicitud para agregar la reseña al servidor');
        const url = 'https://workspace.com/Workspace/Cafe-Querol/?controller=API&action=api';

        try {
            const response = await axios.post(url, formData);
            console.log('Respuesta del servidor:', response.data);
            return response.data; // Devuelve la respuesta del servidor
        } catch (error) {
            console.error('Error al agregar la reseña:', error.message);
            return { error: "Error al agregar la reseña" };
        }
    }
});
