<?php
session_destroy();
require_once "Models/Usuario.php";

if (!empty($_POST)) {
    $correo = $_POST['correo'] ?? "";
    $clave = $_POST['clave'] ?? "";

    if (Usuario::login($correo, $clave)) {
        redirigir(LOCAL_DIR);
    } else {
        $loginFallido = true;
    }
}

renderView();