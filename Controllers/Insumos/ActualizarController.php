<?php
requiereAutenticacion();
requierePermiso("insumos", "eliminar");
require_once "Models/Insumo.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET')
{
    if (empty($_GET['id'])) {
        $_SESSION['errores'][] = "Se debe especificar un insumo";
        redirigir(LOCAL_DIR."/Insumos");
    }

    $insumo = Insumo::cargar($_GET['id']);

    if (is_null($insumo)) {
        $_SESSION['errores'][] = "El insumo que intenta actulizar no existe";
        redirigir(LOCAL_DIR."/Insumos");
    }

    $roles = Rol::listar(1);

    renderView();
}
elseif ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $insumo = new Insumo();
    $insumo->mapearFormulario();
    
    if (!$insumo->esValido()) {
        renderView();
    }

    if ($insumo->actualizar()) {
        $_SESSION['exitos'][] = "Insumo actualizado con exito";
        Bitacora::registrar("Insumo '".$insumo->getDescripcion()."' actualizado");
    }

    redirigir(LOCAL_DIR."/Insumos");
}
else
{
    http_response_code(405);
    exit;
}