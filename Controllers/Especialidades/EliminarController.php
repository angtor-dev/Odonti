<?php
requiereAutenticacion();
requierePermiso("especialidades", "eliminar");
require_once "Models/Especialidad.php";

$especialidad = Especialidad::cargar($_GET['id']);

if (empty($especialidad)) {
    $_SESSION['errores'][] = "La especialidad que intenta eliminar no existe";
    redirigir(LOCAL_DIR."/Especialidades");
}

if ($especialidad->eliminar()) {
    $_SESSION['exitos'][] = "Especialidad eliminada con exito";
    Bitacora::registrar("Especialidad '".$especialidad->getNombre()."' eliminada");
}

redirigir(LOCAL_DIR."/Especialidades");