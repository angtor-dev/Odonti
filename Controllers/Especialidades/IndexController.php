<?php
requiereAutenticacion();
requierePermiso("especialidades", "consultar");
require_once "Models/Especialidad.php";

$especialidades = Especialidad::listar(1);

renderView();