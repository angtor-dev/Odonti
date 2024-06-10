<?php
requiereAutenticacion();

$usuario = Usuario::cargar($_GET['id']);

if (empty($usuario)) {
    $_SESSION['errores'][] = "El usuario que intenta eliminar no existe";
    redirigir(LOCAL_DIR."/Usuarios");
}

if ($usuario->eliminar(1)) {
    $_SESSION['exitos'][] = "Usuario eliminado con exito";
}

redirigir(LOCAL_DIR."/Usuarios");