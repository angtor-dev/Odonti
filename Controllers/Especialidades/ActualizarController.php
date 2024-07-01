<?php
requiereAutenticacion();
requierePermiso("especialidades", "eliminar");
require_once "Models/Especialidad.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET')
{
    if (empty($_GET['id'])) {
        $_SESSION['errores'][] = "Se debe especificar un especialidad";
        redirigir(LOCAL_DIR."/Especialidades");
    }

    $especialidad = Especialidad::cargar($_GET['id']);

    if (is_null($especialidad)) {
        $_SESSION['errores'][] = "La especialidad que intenta actulizar no existe";
        redirigir(LOCAL_DIR."/Especialidades");
    }

    $roles = Rol::listar(1);

    require_once "Views/Especialidades/_Actualizar.php";
}
elseif ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $especialidad = new Especialidad();
    $especialidad->mapearFormulario();

    if ($especialidad->esValido() && $especialidad->actualizar()) {
        $_SESSION['exitos'][] = "Especialidad actualizada con exito";
        Bitacora::registrar("Especialidad '".$especialidad->getNombre()."' actualizada");
    }

    redirigir(LOCAL_DIR."/Especialidades");
}
else
{
    http_response_code(405);
    exit;
}