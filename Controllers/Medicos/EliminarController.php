<?php
requiereAutenticacion();
requierePermiso("medicos", "eliminar");
require_once "models/Medico.php";

$medico = Medico::cargar($_GET['id']);

if (empty($medico)) {
    $_SESSION['errores'][] = "El medico que intenta eliminar no existe";
    redirigir(LOCAL_DIR."/Medicos");
}

if ($medico->eliminar(1)) {
    $_SESSION['exitos'][] = "Medico eliminado con exito";
    Bitacora::registrar("medico '".$medico->getNombreCompleto()."' eliminado");
}

redirigir(LOCAL_DIR."/Medicos");