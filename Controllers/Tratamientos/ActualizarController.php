<?php
requiereAutenticacion();
requierePermiso("tratamientos", "eliminar");
require_once "Models/Tratamiento.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET')
{
    if (empty($_GET['id'])) {
        $_SESSION['errores'][] = "Se debe especificar un tratamiento";
        redirigir(LOCAL_DIR."/Tratamientos");
    }

    $tratamiento = Tratamiento::cargar($_GET['id']);

    if (is_null($tratamiento)) {
        $_SESSION['errores'][] = "El tratamiento que intenta actulizar no existe";
        redirigir(LOCAL_DIR."/Tratamientos");
    }

    $roles = Rol::listar(1);

    renderView();
}
elseif ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $tratamiento = new Tratamiento();
    $tratamiento->mapearFormulario();
    // TODO: Validar

    if ($tratamiento->actualizar()) {
        $_SESSION['exitos'][] = "Tratamiento actualizado con exito";
    }

    redirigir(LOCAL_DIR."/Tratamientos");
}
else
{
    http_response_code(405);
    exit;
}