<?php
requiereAutenticacion();
requierePermiso("tratamientos", "eliminar");
require_once "Models/Tratamiento.php";

$tratamiento = Tratamiento::cargar($_GET['id']);

if (empty($tratamiento)) {
    $_SESSION['errores'][] = "El tratamiento que intenta eliminar no existe";
    redirigir(LOCAL_DIR."/Tratamientos");
}

if ($tratamiento->eliminar()) {
    $_SESSION['exitos'][] = "Tratamiento eliminado con exito";
}

redirigir(LOCAL_DIR."/Tratamientos");