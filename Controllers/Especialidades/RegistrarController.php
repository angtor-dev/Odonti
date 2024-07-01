<?php
requiereAutenticacion();
requierePermiso("especialidades", "registrar");
require_once "Models/Especialidad.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET')
{
    require_once "Views/Especialidades/_Registrar.php";
}
elseif ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $especialidad = new Especialidad();
    $especialidad->mapearFormulario();

    if ($especialidad->esValido() && $especialidad->registrar()) {
        $_SESSION['exitos'][] = "Especialidad registrada con exito";
        Bitacora::registrar("Especialidad '".$especialidad->getNombre()."' registrada");
    }

    redirigir(LOCAL_DIR."/Especialidades");
}
else
{
    http_response_code(405);
    exit;
}