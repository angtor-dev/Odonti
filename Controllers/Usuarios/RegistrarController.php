<?php
requiereAutenticacion();
requierePermiso("usuarios", "registrar");

if ($_SERVER['REQUEST_METHOD'] === 'GET')
{
    $roles = Rol::listar(1);

    renderView();
}
elseif ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $usuario = new Usuario();
    $usuario->mapearFormulario();
    // TODO: Validar

    if ($usuario->registrar()) {
        $_SESSION['exitos'][] = "Usuario registrado con exito";
        Bitacora::registrar("Usuario '".$usuario->getCorreo()."' registrado");
    }

    redirigir(LOCAL_DIR."/Usuarios");
}
else
{
    http_response_code(405);
    exit;
}