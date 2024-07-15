<?php
requiereAutenticacion();
requierePermiso("pacientes", "actualizar");
require_once"models/Paciente.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET')
{
    if (empty($_GET['id'])) {
        $_SESSION['errores'][] = "Se debe especificar un paciente";
        redirigir(LOCAL_DIR."/Pacientes");
    }

    $paciente = Paciente::cargar($_GET['id']);

    if (is_null($paciente)) {
        $_SESSION['errores'][] = "El paciente que intenta actulizar no existe";
        redirigir(LOCAL_DIR."/Pacientes");
    }

    $roles = Rol::listar(1);

    require_once "Views/Pacientes/_Actualizar.php";
}
elseif ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $paciente = new Paciente();
    $paciente->mapearFormulario();
    // TODO: Validar

    if ($paciente->actualizar()) {
        $_SESSION['exitos'][] = "Paciente actualizado con exito";
        Bitacora::registrar("Paciente '".$especialidad->getNombre()."' actualizado");
    }

    redirigir(LOCAL_DIR."/Pacientes");
}
else
{
    http_response_code(405);
    exit;
}