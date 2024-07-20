<?php
requiereAutenticacion();
requierePermiso("consultas", "actualizar");
require_once "models/Consulta.php";
require_once "models/Servicio.php";

if (empty($_GET['idConsulta']) || empty($_GET['idServicio'])) {
    $_SESSION['errores'][] = "Se debe especificar una consulta y un servicio";
    redirigir(LOCAL_DIR."/Consultas");
}

/** @var Consulta */
$consulta = Consulta::cargar($_GET['idConsulta']);
/** @var Servicio */
$servicio = Servicio::cargar($_GET['idServicio']);

$consulta->agregarServicio($servicio->id);
Bitacora::registrar("Servicio '".$servicio->getNombre()."' agregado a la consulta #".$consulta->id);

redirigir(LOCAL_DIR."/Consultas/Actualizar?id=".$consulta->id);