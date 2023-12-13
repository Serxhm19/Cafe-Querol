<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-SsDkMO9SMV3F8C3QvxZjScNB6eScB8peVp/UL6ZI3jFhAxVdfdC4vhm3ZXiU04QE"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="Style\stylelogin.css">
    <title>login</title>
</head>
<header>
    <section>
        <div class="row">
            <div class="Header2 col-4">
                <img src="img/icons/coffee.png" alt="coffee">
                <h3>TOMA LO QUE QUIERAS MIENTRAS COMPRAS</h3>
            </div>
            <div class="Header2 col-4">
                <img src="img/icons/coffee-cup.png" alt="coffee">
                <h3>COME AQUI O LLEVATELO A CASA</h3>
            </div>
            <div class="Header2 col-4">
                <img src="img/icons/cake.png" alt="cake">
                <h3>SERVICIO DE COMIDA</h3>
            </div>
        </div>
    </section>
    <section>
        <div class="header3">
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                    <a class="navbar-brand" href="?controller=producto"><img src="img\IMGHome\logo_principal.png"
                            alt="logo"></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="?controller=producto">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page"
                                    href="?controller=producto&action=Carta">Carta</a>
                            </li>
                        </ul>
                        <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Buscar">
                            <button class="btn" type="submit">Buscar</button>
                        </form>
                        <a class="navbar-account" href="?controller=producto"><img src="img\icons\icon-account.png"
                                alt="logo"></a>
                        <a class="navbar-cart" href="?controller=producto&action=Carrito">
                            <img src="img\icons\carrito-de-compras.png" alt="logo">
                            <?php
                            include('utils/Funciones.php');
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
    <section class="breadcrumb">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="?controller=producto">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Registrate</li>
            </ol>
        </nav>
    </section>
    <div>
        <h1 id="identificate">IDENTIFICATE</h1>
    </div>
    <div class="forms-container">
        <div class="form-container">
            <form action="?controller=usuario&action=verificarCorreo" method="post">
                <legend>Regístrate</legend>
                <?php if (isset($_SESSION['errorMessage'])): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $_SESSION['errorMessage']; ?>
                    </div>
                    <?php unset($_SESSION['errorMessage']); // Limpiar la variable de sesión ?>
                <?php endif; ?>
                <div class="mb-3">
                    <div id="emailHelp" class="form-text">Escríbenos tu email para crear tu cuenta</div>
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                        aria-describedby="emailHelp">
                </div>
                <button type="submit" class="btn btn-primary">CREAR UNA CUENTA</button>
            </form>
        </div>


        <div class="form-container">
            <div class="form-container2">
                <form action="?controller=usuario&action=Logged" method="post">
                    <legend>Identifícate</legend>
                    <?php if (isset($_SESSION['errorMessage'])): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $_SESSION['errorMessage']; ?>
                        </div>
                        <?php unset($_SESSION['errorMessage']); // Limpiar la variable de sesión ?>
                    <?php endif; ?>
                    <div class="mb-3">
                        <div id="emailHelp" class="form-text">Introduce tu dirección de email y contraseña para
                            identificarte.</div>
                        <label for="exampleInputEmail2" class="form-label">Email address</label>
                        <input type="email" class="form-control" name="email" id="exampleInputEmail2"
                            aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="exampleInputPassword1" required>
                    </div>
                    <button type="submit" class="btn btn-primary">ENTRAR EN LA CUENTA</button>
                </form>
            </div>
        </div>
    </div>
    </section>
    <hr>
    <!-- Newsletter Section -->
    <div class="newsletter mt-4">
        <h3>¿Quieres recibir nuestras ofertas y novedades?</h3>
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <input type="text" class="form-control" placeholder="Introduce tu e-mail para suscribirte">
            </div>
            <div class="col-md-6 col-sm-12 mt-2 mt-md-0">
                <button type="button" class="btn btn-primary newsletter">ENVIAR</button>
            </div>
        </div>
    </div>

    <!-- Privacy Checkbox Section -->
    <div class="privacy-checkbox mt-2">
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="privacyCheckbox">
            <label class="form-check-label" for="privacyCheckbox">
                He leído y acepto la <a href="#">Política de privacidad</a>
            </label>
        </div>
    </div>
    </section>
</body>
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


</html>