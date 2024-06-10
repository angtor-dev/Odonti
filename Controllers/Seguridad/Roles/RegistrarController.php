<?php
requiereAutenticacion();
requierePermiso("roles", "registrar");

if ($_SERVER['REQUEST_METHOD'] === 'GET')
{
    renderView();
}
elseif ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $rol = new Rol();
    $rol->mapearFormulario();
    // TODO: Validar

    if ($rol->registrar()) {
        $_SESSION['exitos'][] = "Rol registrado con exito";
    }

    redirigir(LOCAL_DIR."/Seguridad/Roles");
}
else
{
    http_response_code(405);
    exit;
}