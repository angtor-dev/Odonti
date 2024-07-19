<?php
requiereAutenticacion();
requierePermiso("servicios", "actualizar");
require_once "Models/Servicio.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET')
{
    if (empty($_GET['id'])) {
        $_SESSION['errores'][] = "Se debe especificar un servicio";
        redirigir(LOCAL_DIR."/Servicios");
    }

    $servicio = Servicio::cargar($_GET['id']);

    if (is_null($servicio)) {
        $_SESSION['errores'][] = "El servicio que intenta actulizar no existe";
        redirigir(LOCAL_DIR."/Servicios");
    }

    $roles = Rol::listar(1);

    renderView();
}
elseif ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $servicio = new Servicio();
    $servicio->mapearFormulario();
    
    if (!$servicio->esValido()) {
        renderView();
    }

    if ($servicio->actualizar()) {
        $_SESSION['exitos'][] = "Servicio actualizado con exito";
        Bitacora::registrar("Servicio '".$servicio->getNombre()."' actualizado");
    }

    redirigir(LOCAL_DIR."/Servicios");
}
else
{
    http_response_code(405);
    exit;
}