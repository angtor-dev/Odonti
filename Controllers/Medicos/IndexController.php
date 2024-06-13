<?php
requiereAutenticacion();
requierePermiso("medicos", "consultar");
require_once "models/Medico.php";

$medicos = Medico::listar(1);

renderView();