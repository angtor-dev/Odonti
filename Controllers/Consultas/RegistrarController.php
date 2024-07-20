<?php
requiereAutenticacion();
requierePermiso("consultas", "registrar");
require_once "Models/Consulta.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET')
{
    $pacientes = Paciente::listar(1);
    $medicos = Medico::listar(1);

    require_once "Views/Consultas/_Registrar.php";
}
elseif ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $consulta = new Consulta();
    $consulta->mapearFormulario();

    if ($consulta->esValido()) {
        $consulta = $consulta->registrar();
        $_SESSION['exitos'][] = "Consulta registrada con exito";
        Bitacora::registrar("Consulta '".$consulta->id."' registrada");
        redirigir(LOCAL_DIR."/Consultas/Actualizar?id=".$consulta->id);
    }

    redirigir(LOCAL_DIR."/Consultas");
}
else
{
    http_response_code(405);
    exit;
}