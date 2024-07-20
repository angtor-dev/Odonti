<?php
requiereAutenticacion();
requierePermiso("consultas", "consultar");
require_once "models/Consulta.php";

$consultas = Consulta::listar(1);

renderView();