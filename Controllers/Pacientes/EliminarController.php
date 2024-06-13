<?php
requiereAutenticacion();
requierePermiso("pacientes", "eliminar");
require_once"models/Paciente.php";

$paciente = Paciente::cargar($_GET['id']);

if (empty($paciente)) {
    $_SESSION['errores'][] = "El paciente que intenta eliminar no existe";
    redirigir(LOCAL_DIR."/Pacientes");
}

if ($paciente->eliminar(1)) {
    $_SESSION['exitos'][] = "Paciente eliminado con exito";
}

redirigir(LOCAL_DIR."/Pacientes");