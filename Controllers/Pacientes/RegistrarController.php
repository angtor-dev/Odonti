<?php
requiereAutenticacion();
requierePermiso("pacientes", "registrar");
require_once"models/Paciente.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET')
{
    $roles = Rol::listar(1);

    renderView();
}
elseif ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $paciente = new Paciente();
    $paciente->mapearFormulario();
    // TODO: Validar

    if ($paciente->registrar()) {
        $_SESSION['exitos'][] = "Paciente registrado con exito";
    } else {
        $_SESSION['errores'][] = "Ocurrio un error al registrar a el paciente";
    }

    redirigir(LOCAL_DIR."/Pacientes");
}
else
{
    http_response_code(405);
    exit;
}