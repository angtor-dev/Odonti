<?php
requiereAutenticacion();
requierePermiso("pacientes", "consultar");
require_once"models/Paciente.php";
require_once"models/Consulta.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET')
{
    if (empty($_GET['id'])) {
        $_SESSION['errores'][] = "Se debe especificar un paciente";
        redirigir(LOCAL_DIR."/Pacientes");
    }

    $paciente = Paciente::cargar($_GET['id']);

    if (is_null($paciente)) {
        $_SESSION['errores'][] = "El paciente especificado no existe";
        redirigir(LOCAL_DIR."/Pacientes");
    }

    $consultas = Consulta::listarPorPaciente($paciente->id);

    renderView();
}
else
{
    http_response_code(405);
    exit;
}
