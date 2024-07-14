<?php
requiereAutenticacion();
requierePermiso("medicamentos", "eliminar");
require_once "Models/Medicamento.php";

$medicamento = Medicamento::cargar($_GET['id']);

if (empty($medicamento)) {
    $_SESSION['errores'][] = "El medicamento que intenta eliminar no existe";
    redirigir(LOCAL_DIR."/Medicamentos");
}

if ($medicamento->eliminar()) {
    $_SESSION['exitos'][] = "Medicamento eliminado con exito";
    Bitacora::registrar("Medicamento '".$medicamento->getNombre()."' eliminado");
}

redirigir(LOCAL_DIR."/Medicamentos");