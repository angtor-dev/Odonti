<?php
requiereAutenticacion();
requierePermiso("estudiantes", "eliminar");
require_once "models/Estudiante.php";
require_once "models/Paciente.php";

$estudiante = Estudiante::cargar($_GET['id']);

if (empty($estudiante)) {
    $_SESSION['errores'][] = "El estudiante que intenta eliminar no existe";
    redirigir(LOCAL_DIR."/Estudiantes");
}

if ($estudiante->eliminar(1)) {
    $_SESSION['exitos'][] = "Estudiante eliminado con exito";
}

redirigir(LOCAL_DIR."/Estudiantes");