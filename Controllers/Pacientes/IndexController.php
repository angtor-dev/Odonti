<?php
requiereAutenticacion();
requierePermiso("pacientes", "consultar");
require_once "models/Paciente.php";

$pacientes = Paciente::listar(1);

renderView();