<?php
requiereAutenticacion();
requierePermiso("tratamientos", "consultar");
require_once "Models/Tratamiento.php";

$tratamientos = Tratamiento::listar(1);

renderView();