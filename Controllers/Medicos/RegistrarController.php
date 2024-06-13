<?php
requiereAutenticacion();
requierePermiso("medicos", "registrar");
require_once "models/Medico.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET')
{
    $roles = Rol::listar(1);

    renderView();
}
elseif ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $medico = new Medico();
    $medico->mapearFormulario();
    // TODO: Validar

    if ($medico->registrar()) {
        $_SESSION['exitos'][] = "Medico registrado con exito";
        Bitacora::registrar("Medico '".$medico->getCorreo()."' registrado");
    }

    redirigir(LOCAL_DIR."/Medicos");
}
else
{
    http_response_code(405);
    exit;
}