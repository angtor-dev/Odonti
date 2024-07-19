<?php
requiereAutenticacion();
requierePermiso("consultas", "actualizar");
require_once "models/Consulta.php";
require_once "models/Servicio.php";

$consulta = Consulta::cargar($_GET['id']);
$servicios = Servicio::listar(1);

renderComponent("_ModalServicios");