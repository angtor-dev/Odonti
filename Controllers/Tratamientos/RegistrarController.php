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
    
    if (!$tratamiento->esValido()) {
        redirigir(LOCAL_DIR."/Tratamientos/Registrar");
    }

    if ($tratamiento->registrar()) {
        $_SESSION['exitos'][] = "Tratamiento registrado con exito";
        Bitacora::registrar("Tratamiento '".$tratamiento->getNombre()."' registrado");
    }

    redirigir(LOCAL_DIR."/Tratamientos");
}
else
{
    http_response_code(405);
    exit;
}