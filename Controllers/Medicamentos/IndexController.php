<?php
requiereAutenticacion();
requierePermiso("medicamentos", "consultar");
require_once "Models/Medicamento.php";

$medicamentos = Medicamento::listar(1);

renderView();