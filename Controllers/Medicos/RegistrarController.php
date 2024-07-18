<?php
requiereAutenticacion();
requierePermiso("medicos", "registrar");
require_once "models/Medico.php";
require_once "models/Especialidad.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET')
{
    $especialidades = Especialidad::listar(1);

    require_once "Views/Medicos/_Registrar.php";
}
elseif ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $medico = new Medico();
    $medico->mapearFormulario();

    if ($medico->esValido() && $medico->registrar()) {
        $_SESSION['exitos'][] = "Medico registrado con exito";
        Bitacora::registrar("Medico '".$medico->getNombreCompleto()."' registrado");
    }

    redirigir(LOCAL_DIR."/Medicos");
}
else
{
    http_response_code(405);
    exit;
}