<?php
requiereAutenticacion();
requierePermiso("consultas", "actualizar");
require_once "models/Consulta.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET')
{
    if (empty($_GET['id'])) {
        $_SESSION['errores'][] = "Se debe especificar una consulta";
        redirigir(LOCAL_DIR."/Consultas");
    }

    $consulta = Consulta::cargar($_GET['id']);

    if (is_null($consulta)) {
        $_SESSION['errores'][] = "La consulta que intenta actulizar no existe";
        redirigir(LOCAL_DIR."/Consultas");
    }

    $pacientes = Paciente::listar(1);
    $medicos = Medico::listar(1);

    renderView();
}
elseif ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $consulta = new Consulta();
    $consulta->mapearFormulario();

    if ($consulta->esValido() && $consulta->actualizar()) {
        $_SESSION['exitos'][] = "Consulta actualizado con exito";
        Bitacora::registrar("Consulta '".$consulta->id."' actualizada");
    }

    redirigir(LOCAL_DIR."/Consultas");
}
else
{
    http_response_code(405);
    exit;
}