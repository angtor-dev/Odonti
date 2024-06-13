<?php
requiereAutenticacion();
requierePermiso("lotes", "consultar");
require_once "Models/Lote.php";

$insumo = Insumo::cargar($_GET['id']);
$lotes = Lote::listarPorRelacion($insumo->id, "Insumo");

renderComponent("_OffcanvasLotes");