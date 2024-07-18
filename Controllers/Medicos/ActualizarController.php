<?php
requiereAutenticacion();
requierePermiso("medicos", "actualizar");
require_once "models/Medico.php";
require_once "models/Especialidad.php";

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
    
    $especialidades = Especialidad::listar(1);

    require_once "Views/Medicos/_Actualizar.php";
}
elseif ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $medico = new Medico();
    $medico->mapearFormulario();

    if ($medico->esValido() && $medico->actualizar()) {
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