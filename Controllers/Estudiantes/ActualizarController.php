<?php
requiereAutenticacion();
requierePermiso("estudiantes", "actualizar");
require_once "models/Estudiante.php";
require_once "models/Paciente.php";

    $pacientes = Paciente::listar(1);

if ($_SERVER['REQUEST_METHOD'] === 'GET')
{
    if (empty($_GET['id'])) {
        $_SESSION['errores'][] = "Se debe especificar un estudiante";
        redirigir(LOCAL_DIR."/Estudiantes");
    }

    $estudiante = Estudiante::cargar($_GET['id']);

    if (is_null($estudiante)) {
        $_SESSION['errores'][] = "El estudiante que intenta actulizar no existe";
        redirigir(LOCAL_DIR."/Estudiantes");
    }

    $roles = Rol::listar(1);

    renderView();
}
elseif ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $estudiante = new Estudiante();
    $estudiante->mapearFormulario();
    // TODO: Validar

    if ($estudiante->actualizar()) {
        $_SESSION['exitos'][] = "estudiante actualizado con exito";
    } else {
        $_SESSION['errores'][] = "Ocurrio un error al actualizar a el estudiante";
    }

    redirigir(LOCAL_DIR."/Estudiantes");
}
else
{
    http_response_code(405);
    exit;
}