<?php
requiereAutenticacion();
requierePermiso("citas", "consultar");
require_once "models/Cita.php";
require_once "models/Paciente.php";
require_once "models/Medico.php";

$citas = Cita::listar(1);

renderView();