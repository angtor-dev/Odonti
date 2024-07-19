<?php
requiereAutenticacion();
requierePermiso("pacientes", "registrar");
require_once "models/Paciente.php";
require_once "models/Antecedente.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET')
{
    $antecedentes = Antecedente::listar(1);

    require_once "Views/Pacientes/_Registrar.php";
}
elseif ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $paciente = new Paciente();
    $paciente->mapearFormulario();
    // TODO: Validar

    if ($paciente->registrar()) {
        $_SESSION['exitos'][] = "Paciente registrado con exito";
        Bitacora::registrar("Paciente '".$paciente->getNombre()."' registrado");
    }

    redirigir(LOCAL_DIR."/Pacientes");
}
else
{
    http_response_code(405);
    exit;
}