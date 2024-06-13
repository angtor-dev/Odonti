<?php
requiereAutenticacion();
requierePermiso("insumos", "consultar");
require_once "Models/Insumo.php";

$insumos = Insumo::listar(1);

renderView();