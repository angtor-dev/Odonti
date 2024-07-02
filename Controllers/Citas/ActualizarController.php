<?php
requiereAutenticacion();
requierePermiso("medicos", "actualizar");
require_once "models/Medico.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET')
{
    if (empty($_GET['id'])) {
        $_SESSION['errores'][] = "Se debe especificar un medico";
        redirigir(LOCAL_DIR."/Medicos");
    }

    $medico = Medico::cargar($_GET['id']);

    if (is_null($medico)) {
        $_SESSION['errores'][] = "El medico que intenta actulizar no existe";
        redirigir(LOCAL_DIR."/Medicos");
    }

    $roles = Rol::listar(1);

    renderView();
}
elseif ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $medico = new Medico();
    $medico->mapearFormulario();
    // TODO: Validar

    if ($medico->actualizar()) {
        $_SESSION['exitos'][] = "Medico actualizado con exito";
        Bitacora::registrar("Medico '".$medico->getNombreCompleto()."' actualizado");
    }

    redirigir(LOCAL_DIR."/Medicos");
}
else
{
    http_response_code(405);
    exit;
}