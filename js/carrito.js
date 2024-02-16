// Ahora en tu archivo JavaScript
$('#btnPagar').click(function (e) {
    e.preventDefault(); // Evita que el formulario se envíe de forma normal

    // Obtén los datos del formulario
    var formData = $('form').serialize();

    // Realiza una solicitud AJAX al servidor
    $.ajax({
        type: 'POST',
        url: '?controller=producto&action=insertarDetallesPedido',
        data: formData,
        success: function (response) {
            // Genera el código QR una vez que se haya enviado el formulario
            var qrCodeBaseUri = 'https://api.qrserver.com/v1/create-qr-code/?',
                params = {
                    data: 'https://workspace.com/Workspace/Cafe-Querol/?controller=usuario&action=visualizarPedido&ID_PEDIDO=' + response.ID_PEDIDO, // Actualización de la URL
                    size: '150x150',
                    margin: 1,
                    download: 1
                };

            var link = document.createElement('a');
            var fileName = 'qr_code_' + new Date().toISOString().slice(0, 10) + '.png'; // Nombre del archivo con la fecha actual
            link.download = fileName;
            link.href = qrCodeBaseUri + $.param(params);
            link.click();

            // Redireccionar al dashboard después de 2 segundos
            setTimeout(function () {
                window.location.href = 'https://workspace.com/Workspace/Cafe-Querol/?controller=usuario&action=mispedidos';
            }, 200); 


        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
});


document.addEventListener('DOMContentLoaded', function () {
    // Obtener referencias a elementos HTML relevantes
    var propinaToggle = document.getElementById('propina-toggle');
    var propinaSlider = document.getElementById('propina-slider');
    var propinaRange = document.getElementById('propina-range');
    var propinaValue = document.getElementById('propina-value');
    var cantidadPropina = document.getElementById('cantidad-propina');
    var totalConPropinaValor = document.getElementById('total-con-propina-valor');

    // Obtener el precio total de la compra desde el script incluido en el HTML
    var totalPedido = precioTotal;

    // Función para actualizar el valor del porcentaje de propina y el total con propina
    function actualizarPropinaYTotal() {
        var porcentajePropina = propinaRange.value;
        var propina = (totalPedido * porcentajePropina) / 100;
        var totalConPropina = totalPedido + propina;

        // Actualizar el valor del porcentaje de propina y el total con propina en los elementos HTML
        propinaValue.textContent = porcentajePropina + '%';
        cantidadPropina.textContent = propina.toFixed(2);
        // Actualizar el valor total del pedido incluyendo la propina
        totalConPropinaValor.textContent = (totalPedido + propina).toFixed(2);
    }

    // Función para actualizar el total con propina
    function actualizarTotalConPropina() {
        // Obtener el valor de la propina
        var propina = parseFloat(cantidadPropina.textContent);
        // Actualizar el total con propina
        totalConPropinaValor.textContent = (totalPedido + propina).toFixed(2);
    }

    // Actualizar el precio total al cargar la página
    actualizarTotalConPropina();

    // Escuchar cambios en los checkboxes de propina
    propinaToggle.addEventListener('change', function () {
        if (this.checked) {
            // Mostrar el slider y actualizar el total con propina si se selecciona la propina
            propinaSlider.style.display = 'block';
            // Actualizar el precio total considerando la propina
            actualizarTotalConPropina();
            document.getElementById('total-con-propina').style.display = 'block';
            // Desmarcar el checkbox de omitir propina si se selecciona la propina
            document.getElementById('omitir-propina').checked = false;
        } else {
            // Ocultar el slider si no se selecciona la propina
            propinaSlider.style.display = 'none';
            // Restaurar el precio total sin propina
            totalConPropinaValor.textContent = precioTotal;
            document.getElementById('total-con-propina').style.display = 'block'; // Mostrar siempre el precio total
        }
    });

    // Escuchar cambios en el checkbox de omitir propina
    document.getElementById('omitir-propina').addEventListener('change', function () {
        if (this.checked) {
            // Establecer la propina a 0 si se selecciona omitir propina
            cantidadPropina.textContent = '0.00';
            // Actualizar el total con propina a 0
            totalConPropinaValor.textContent = totalPedido.toFixed(2);
            // Desmarcar el checkbox de propina si se selecciona omitir propina
            document.getElementById('propina-toggle').checked = false;
            // Ocultar el slider de propina si se selecciona omitir propina
            propinaSlider.style.display = 'none';
        } else {
            // Mostrar el slider si se deselecciona omitir propina y está seleccionada la propina
            if (propinaToggle.checked) {
                propinaSlider.style.display = 'block';
            }
        }
    });

    // Escuchar cambios en el rango de propina
    propinaRange.addEventListener('input', function () {
        // Actualizar el valor del porcentaje de propina y el total con propina
        actualizarPropinaYTotal();
    });

    // Escuchar cambios en el rango de propina para actualizar el total con propina
    propinaRange.addEventListener('input', function () {
        // Actualizar el total con propina cuando se cambia el rango de propina
        actualizarTotalConPropina();
    });
});
