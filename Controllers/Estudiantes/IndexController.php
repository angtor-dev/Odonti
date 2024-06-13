<?php
requiereAutenticacion();
requierePermiso("estudiantes", "consultar");
require_once "models/Estudiante.php"

$estudiantes = Estudiante::listar(1);

renderView();