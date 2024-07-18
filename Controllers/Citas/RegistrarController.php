<?php
requiereAutenticacion();
requierePermiso("citas", "registrar");
require_once "models/Cita.php";
require_once "models/Paciente.php";
require_once "models/Medico.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET')
{
    $pacientes = Paciente::listar(1);
    $medicos = Medico::listar(1);

    require_once "Views/Citas/_Registrar.php";
}
elseif ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $cita = new Cita();
    $cita->mapearFormulario();

    if ($cita->esValido() && $cita->registrar()) {
        $_SESSION['exitos'][] = "Cita registrada con exito";
        Bitacora::registrar("Cita '".$cita->getFecha()."' registrada");
    }

    redirigir(LOCAL_DIR."/Citas");
}
else
{
    http_response_code(405);
    exit;
}