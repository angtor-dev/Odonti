<?php
requiereAutenticacion();
requierePermiso("consultas", "actualizar");
require_once "models/Consulta.php";
require_once "models/Servicio.php";

/** @var Consulta */
$consulta = Consulta::cargar($_GET['idConsulta']);
$servicio = Servicio::cargar($_GET['idServicio']);

if (empty($consulta)) {
    $_SESSION['errores'][] = "La consulta que intenta eliminar no existe";
    redirigir(LOCAL_DIR."/Citas");
}

if ($consulta->eliminarServicio($servicio->id)) {
    $_SESSION['exitos'][] = "Servicio eliminado de la consulta con exito";
}

redirigir(LOCAL_DIR."/Citas/AsociarConsulta?id=".$consulta->cita->id);