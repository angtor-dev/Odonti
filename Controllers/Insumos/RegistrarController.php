<?php
requiereAutenticacion();
requierePermiso("insumos", "registrar");
require_once "Models/Insumo.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET')
{
    renderView();
}
elseif ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $insumo = new Insumo();
    $insumo->mapearFormulario();
    
    if (!$insumo->esValido()) {
        redirigir(LOCAL_DIR."/Insumos/Registrar");
    }

    if ($insumo->registrar()) {
        $_SESSION['exitos'][] = "Insumo registrado con exito";
        Bitacora::registrar("Insumo '".$insumo->getDescripcion()."' registrado");
    }

    redirigir(LOCAL_DIR."/Insumos");
}
else
{
    http_response_code(405);
    exit;
}