<?php

echo 'este es tu panel de pedidos';
if (isset($_GET['controller'])) {
    echo 'Quieres realizar una accion sobre ' . $_GET['controller'];
    if (isset($_GET['action'])) {
        echo 'Sobre' . $_GET['controller'] . 'quieres mostrar la pagina' . $_GET['action'];
    } else {
        echo 'No me has pasado controller';
    }
}

?>