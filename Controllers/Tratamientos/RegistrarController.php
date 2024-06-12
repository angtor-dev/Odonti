<?php
requiereAutenticacion();
requierePermiso("tratamientos", "registrar");
require_once "Models/Tratamiento.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET')
{
    renderView();
}
elseif ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $tratamiento = new Tratamiento();
    $tratamiento->mapearFormulario();
    // TODO: Validar

    if ($tratamiento->registrar()) {
        $_SESSION['exitos'][] = "Tratamiento registrado con exito";
    } else {
        $_SESSION['errores'][] = "Ocurrio un error al registrar a el tratamiento";
    }

    redirigir(LOCAL_DIR."/Tratamientos");
}
else
{
    http_response_code(405);
    exit;
}