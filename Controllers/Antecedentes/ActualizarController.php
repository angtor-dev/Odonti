<?php
requiereAutenticacion();
requierePermiso("antecedentes", "actualizar");
require_once "Models/Antecedente.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET')
{
    if (empty($_GET['id'])) {
        $_SESSION['errores'][] = "Se debe especificar un antecedente";
        redirigir(LOCAL_DIR."/Antecedentes");
    }

    $antecedente = Antecedente::cargar($_GET['id']);

    if (is_null($antecedente)) {
        $_SESSION['errores'][] = "El antecedente que intenta actulizar no existe";
        redirigir(LOCAL_DIR."/Antecedentes");
    }

    require_once "Views/Antecedentes/_Actualizar.php";
}
elseif ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $antecedente = new Antecedente();
    $antecedente->mapearFormulario();

    if ($antecedente->esValido() && $antecedente->actualizar()) {
        $_SESSION['exitos'][] = "Antecedente actualizado con exito";
        Bitacora::registrar("Antecedente '".$antecedente->getNombre()."' actualizado");
    }

    redirigir(LOCAL_DIR."/Antecedentes");
}
else
{
    http_response_code(405);
    exit;
}