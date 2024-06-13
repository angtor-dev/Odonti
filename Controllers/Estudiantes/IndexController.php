<?php
requiereAutenticacion();
requierePermiso("estudiantes", "consultar");
require_once "models/Estudiante.php";
require_once "models/Paciente.php";

$estudiantes = Estudiante::listar(1);

renderView();