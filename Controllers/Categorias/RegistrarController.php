<?php
requiereAutenticacion();
requierePermiso("categorias", "registrar");
require_once "Models/Categoria.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET')
{
    require_once "Views/Categorias/_Registrar.php";
}
elseif ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $categorias = new Categoria();
    $categorias->mapearFormulario();

    if ($categorias->esValido() && $categorias->registrar()) {
        $_SESSION['exitos'][] = "Categoria registrada con exito";
        Bitacora::registrar("Categoria '".$categorias->getNombre()."' registrada");
    }

    redirigir(LOCAL_DIR."/Categorias");
}
else
{
    http_response_code(405);
    exit;
}