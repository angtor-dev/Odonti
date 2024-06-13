<?php
requiereAutenticacion();
requierePermiso("antecedentes", "registrar");
require_once "Models/Antecedente.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET')
{
    renderView();
}
elseif ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $antecedentes = new Antecedente();
    $antecedentes->mapearFormulario();
    
    if (!$antecedentes->esValido()) {
        redirigir(LOCAL_DIR."/Antecedentes/Registrar");
    }

    if ($antecedentes->registrar()) {
        $_SESSION['exitos'][] = "Antecedente registrado con exito";
        Bitacora::registrar("Antecedente '".$antecedentes->getNombre()."' registrado");
    }

    redirigir(LOCAL_DIR."/Antecedentes");
}
else
{
    http_response_code(405);
    exit;
}