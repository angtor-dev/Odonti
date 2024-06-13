<?php
requiereAutenticacion();
requierePermiso("estudiantes", "registrar");
require_once "models/Estudiante.php";
require_once "models/Paciente.php";

$pacientes = Paciente::listar(1);

if ($_SERVER['REQUEST_METHOD'] === 'GET')
{
    $roles = Rol::listar(1);

    renderView();
}
elseif ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $estudiante = new Estudiante();
    $estudiante->mapearFormulario();
    // TODO: Validar

    if ($estudiante->registrar()) {
        $_SESSION['exitos'][] = "Estudiante registrado con exito";
    } else {
        $_SESSION['errores'][] = "Ocurrio un error al registrar a el estudiante";
    }

    redirigir(LOCAL_DIR."/Estudiantes");
}
else
{
    http_response_code(405);
    exit;
}