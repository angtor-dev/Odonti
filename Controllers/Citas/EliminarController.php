<?php
requiereAutenticacion();
requierePermiso("citas", "eliminar");
require_once "models/Cita.php";
require_once "models/Paciente.php";
require_once "models/Medico.php";

$cita = Cita::cargar($_GET['id']);

if (empty($cita)) {
    $_SESSION['errores'][] = "La cita que intenta eliminar no existe";
    redirigir(LOCAL_DIR."/Citas");
}

if ($cita->eliminar(1)) {
    $_SESSION['exitos'][] = "La cita eliminado con exito";
    Bitacora::registrar("cita '".$cita->getNombreCompleto()."' eliminado");
}

redirigir(LOCAL_DIR."/Medicos");