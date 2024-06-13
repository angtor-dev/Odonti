<?php
requiereAutenticacion();
requierePermiso("insumos", "eliminar");
require_once "Models/Insumo.php";

$insumo = Insumo::cargar($_GET['id']);

if (empty($insumo)) {
    $_SESSION['errores'][] = "El insumo que intenta eliminar no existe";
    redirigir(LOCAL_DIR."/Insumos");
}

if ($insumo->eliminar()) {
    $_SESSION['exitos'][] = "Insumo eliminado con exito";
    Bitacora::registrar("Insumo '".$insumo->getDescripcion()."' eliminado");
}

redirigir(LOCAL_DIR."/Insumos");