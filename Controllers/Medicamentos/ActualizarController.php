<?php
requiereAutenticacion();
requierePermiso("medicamentos", "actualizar");
require_once "Models/Medicamento.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET')
{
    if (empty($_GET['id'])) {
        $_SESSION['errores'][] = "Se debe especificar un medicamento";
        redirigir(LOCAL_DIR."/Medicamentos");
    }

    $medicamento = Medicamento::cargar($_GET['id']);

    if (is_null($medicamento)) {
        $_SESSION['errores'][] = "El medicamento que intenta actulizar no existe";
        redirigir(LOCAL_DIR."/Medicamentos");
    }

    $roles = Rol::listar(1);

    require_once "Views/Medicamentos/_Actualizar.php";
}
elseif ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $medicamento = new Medicamento();
    $medicamento->mapearFormulario();

    if ($medicamento->esValido() && $medicamento->actualizar()) {
        $_SESSION['exitos'][] = "Medicamento actualizado con exito";
        Bitacora::registrar("Medicamento '".$medicamento->getNombre()."' actualizado");
    }

    redirigir(LOCAL_DIR."/Medicamentos");
}
else
{
    http_response_code(405);
    exit;
}