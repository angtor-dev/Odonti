<?php
requiereAutenticacion();
requierePermiso("medicamentos", "registrar");
require_once "Models/Medicamento.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET')
{
    require_once "Views/Medicamentos/_Registrar.php";
}
elseif ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $medicamento = new Medicamento();
    $medicamento->mapearFormulario();

    if ($medicamento->esValido() && $medicamento->registrar()) {
        $_SESSION['exitos'][] = "Medicamento registrada con exito";
        Bitacora::registrar("Medicamento '".$medicamento->getNombre()."' registrado");
    }

    redirigir(LOCAL_DIR."/Medicamentos");
}
else
{
    http_response_code(405);
    exit;
}