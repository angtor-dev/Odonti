<?php
requiereAutenticacion();
requierePermiso("consultas", "actualizar");
require_once "models/Consulta.php";
require_once "models/Servicio.php";

if (empty($_GET['idConsulta']) || empty($_GET['idServicio'])) {
    $_SESSION['errores'][] = "Se debe especificar una consulta y un servicio";
    redirigir(LOCAL_DIR."/Citas");
}

/** @var Consulta */
$consulta = Consulta::cargar($_GET['idConsulta']);
$idServicio = $_GET['idServicio'];

$consulta->agregarServicio($idServicio);

redirigir(LOCAL_DIR."/Citas/AsociarConsulta?id=".$consulta->cita->id);