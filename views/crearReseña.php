<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-SsDkMO9SMV3F8C3QvxZjScNB6eScB8peVp/UL6ZI3jFhAxVdfdC4vhm3ZXiU04QE"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="Style/stylemodificarproducto.css">
    <link rel="icon" type="image/jpg" href="img/icons/logoQuerol.jpg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Café Querol | Tu cafetería de confianza</title>
</head>

<body>
    <header>
        <section>
            <div class="row">
                <div class="Header2 col-12 col-md-4 text-sm-center">
                    <img src="img/icons/coffee.png" alt="coffee">
                    <h3 class="text-sm">TOMA LO QUE QUIERAS MIENTRAS COMPRAS</h3>
                </div>
                <div class="Header2 col-12 col-md-4 text-sm-center">
                    <img src="img/icons/coffee-cup.png" alt="coffee">
                    <h3 class="text-sm">COME AQUÍ O LLEVÁTELO A CASA</h3>
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
                        <a class="navbar-brand" href="?controller=producto"><img src="img/IMGHome/logo_principal.png"
                                alt="logo"></a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="?controller=producto">HOME</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page"
                                        href="?controller=producto&action=Carta">CARTA</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page"
                                        href="?controller=producto&action=Reseñas">RESEÑAS</a>
                                </li>
                            </ul>
                            <form class="d-flex" role="search">
                                <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Buscar">
                                <button class="btn" type="submit">Buscar</button>
                            </form>
                            <a class="navbar-account" href="?controller=usuario&action=redirectToPage"><img
                                    src="img/icons/icon-account.png" alt="logo"></a>
                            <a class="navbar-cart" href="?controller=producto&action=Carrito">
                                <img src="img/icons/carrito-de-compras.png" alt="logo">
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

    <div class="row">
        <div class="col-md-9">
            <div class="formulario">
                <h2>Modificar Producto</h2>
                <form id="formularioResena">
                    <div class="mb-3">
                        <input type="hidden" id="idResena" name="idResena">
                    </div>
                    <div class="mb-3">
                        <input type="hidden" id="idUsuario" name="idUsuario">
                    </div>
                    <div class="mb-3">
                        <label for="idPedidoResena" class="form-label">ID Pedido:</label>
                        <input type="text" class="form-control" id="idPedidoResena" name="idPedidoResena" readonly
                            value="<?php echo $idPedido; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="asuntoResena" class="form-label">Asunto de la Reseña:</label>
                        <input type="text" class="form-control" id="asuntoResena" name="asuntoResena" required>
                    </div>
                    <div class="mb-3">
                        <label for="comentarioResena" class="form-label">Comentario de la Reseña:</label>
                        <textarea class="form-control" id="comentarioResena" name="comentarioResena"
                            required></textarea>
                    </div>
                    <!-- svg from https://es.wikipedia.org/wiki/Archivo:Star*.svg -->
                    <!-- svg from https://es.wikipedia.org/wiki/Archivo:Star*.svg -->

                    <input id=rating0 type=radio value=0 name=rating checked />

                    <label class=star for=rating1>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 300 275">
                            <path stroke="#605a00" stroke-width="15"
                                d="M150 25l29 86h90l-72 54 26 86-73-51-73 51 26-86-72-54h90z" />
                        </svg>
                    </label>
                    <input id=rating1 type=radio value=1 name=rating />

                    <label class=star for=rating2>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 300 275">
                            <path stroke="#605a00" stroke-width="15"
                                d="M150 25l29 86h90l-72 54 26 86-73-51-73 51 26-86-72-54h90z" />
                        </svg>
                    </label>
                    <input id=rating2 type=radio value=2 name=rating />

                    <label class=star for=rating3>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 300 275">
                            <path stroke="#605a00" stroke-width="15"
                                d="M150 25l29 86h90l-72 54 26 86-73-51-73 51 26-86-72-54h90z" />
                        </svg>
                    </label>
                    <input id=rating3 type=radio value=3 name=rating />

                    <label class=star for=rating4>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 300 275">
                            <path stroke="#605a00" stroke-width="15"
                                d="M150 25l29 86h90l-72 54 26 86-73-51-73 51 26-86-72-54h90z" />
                        </svg>
                    </label>
                    <input id=rating4 type=radio value=4 name=rating />

                    <label class=star for=rating5>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 300 275">
                            <path stroke="#605a00" stroke-width="15"
                                d="M150 25l29 86h90l-72 54 26 86-73-51-73 51 26-86-72-54h90z" />
                        </svg>
                    </label>
                    <input id=rating5 type=radio value=5 name=rating />

                    <!-- por último el label del rating 0 ( sin calificar ) -->
                    <label class=reset for=rating0>reset</label>

                    <!-- Otros campos del formulario -->
                    <button type="button" class="btn btn-primary" id="btnAgregarResena">Agregar Reseña</button>

                </form>

            </div>
        </div>
    </div>

    <footer>
        <div class="footer-up">
            <ul>
                <li>
                    <img src="img/icons/facebook.png" alt="Facebook" class="social-icon">
                    <img src="img/icons/facebook2.png" alt="Facebook Hover" class="social-icon-hover">
                </li>
                <li>
                    <img src="img/icons/instagram.png" alt="Instagram" class="social-icon">
                    <img src="img/icons/instagram2.png" alt="Instagram Hover" class="social-icon-hover">
                </li>
            </ul>
        </div>
        <div class="footer-down">
            <p>Copyright 2023 | Sergi Hernández Miras</p>
        </div>
    </footer>
    <!-- Aquí comienza el script -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notie/4.3.1/notie.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
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

            function obtenerValoresDelFormulario() {
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

            document.getElementById("btnAgregarResena").addEventListener("click", async function () {
                var valoresFormulario = obtenerValoresDelFormulario();
                console.log(valoresFormulario);

                let formData = new FormData();
                formData.append('accion', 'add_review');

                for (const [key, value] of Object.entries(valoresFormulario)) {
                    formData.append(key, value);
                }

                const response = await insertarResenaApi(formData);

                mostrarMensaje(response); // Muestra el mensaje con Notie.js
            });

            function mostrarMensaje(response) {
                if (response.exists) {
                    // Ya existe una reseña
                    notie.alert({
                        type: 'error',
                        text: response.error,
                        time: 3 // Duración del mensaje en segundos
                    });
                } else if (response.message) {
                    // Reseña añadida con éxito
                    notie.alert({
                        type: 'success',
                        text: response.message,
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

            async function insertarResenaApi(formData) {
                const url = 'https://workspace.com/Workspace/Cafe-Querol/?controller=API&action=api';

                try {
                    const response = await axios.post(url, formData);
                    return response.data; // Devuelve la respuesta del servidor
                } catch (error) {
                    console.error('Error:', error.message);
                    return { error: "Error al agregar la reseña" };
                }
            }
        });


    </script>
</body>

</html>