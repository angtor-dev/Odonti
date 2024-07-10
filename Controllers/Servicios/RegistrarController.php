<?php
requiereAutenticacion();
requierePermiso("servicios", "registrar");
require_once "Models/Servicio.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET')
{
    renderView();
}
elseif ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $servicio = new Servicio();
    $servicio->mapearFormulario();
    
    if (!$servicio->esValido()) {
        redirigir(LOCAL_DIR."/Servicios/Registrar");
    }

    if ($servicio->registrar()) {
        $_SESSION['exitos'][] = "Servicio registrado con exito";
        Bitacora::registrar("Servicio '".$servicio->getNombre()."' registrado");
    }

    redirigir(LOCAL_DIR."/Servicios");
}
else
{
    http_response_code(405);
    exit;
}