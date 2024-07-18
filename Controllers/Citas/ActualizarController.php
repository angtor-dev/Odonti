<?php
requiereAutenticacion();
requierePermiso("citas", "actualizar");
require_once "models/Cita.php";
require_once "models/Paciente.php";
require_once "models/Medico.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET')
{
    if (empty($_GET['id'])) {
        $_SESSION['errores'][] = "Se debe especificar una cita";
        redirigir(LOCAL_DIR."/Citas");
    }

    $cita = Cita::cargar($_GET['id']);

    if (is_null($cita)) {
        $_SESSION['errores'][] = "La cita que intenta actulizar no existe";
        redirigir(LOCAL_DIR."/Citas");
    }

    $pacientes = Paciente::listar(1);
    $medicos = Medico::listar(1);

    require_once "Views/Citas/_Actualizar.php";
}
elseif ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $cita = new Cita();
    $cita->mapearFormulario();

    if ($cita->esValido() && $cita->actualizar()) {
        $_SESSION['exitos'][] = "Cita actualizado con exito";
        Bitacora::registrar("Cita '".$cita->id."' actualizada");
    }

    redirigir(LOCAL_DIR."/Citas");
}
else
{
    http_response_code(405);
    exit;
}