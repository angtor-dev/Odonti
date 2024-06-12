<?php
requiereAutenticacion();
requierePermiso("antecedentes", "eliminar");
require_once "Models/Antecedente.php";

$antecedente = Antecedente::cargar($_GET['id']);

if (empty($antecedente)) {
    $_SESSION['errores'][] = "El antecedente que intenta eliminar no existe";
    redirigir(LOCAL_DIR."/Antecedentes");
}

if ($antecedente->eliminar()) {
    $_SESSION['exitos'][] = "Antecedente eliminado con exito";
    Bitacora::registrar("Antecedente '".$antecedente->getNombre()."' eliminado");
}

redirigir(LOCAL_DIR."/Antecedentes");