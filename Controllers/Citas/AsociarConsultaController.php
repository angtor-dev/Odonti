<?php
requiereAutenticacion();
requierePermiso("consultas", "registrar");
requierePermiso("consultas", "actualizar");
require_once "models/Cita.php";
require_once "models/Consulta.php";
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
    
    $consulta = Consulta::listarPorRelacion($cita->id, get_class($cita))[0] ?? null;

    if (is_null($consulta)) {
        $consulta = new Consulta();
        $consulta->setDatos($cita->id, date('Y-m-d'), "");
        $consulta->registrar();
        $consulta = Consulta::listarPorRelacion($cita->id, get_class($cita))[0];
    }

    $servicios = Servicio::listar(1);

    renderView("Consulta");
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