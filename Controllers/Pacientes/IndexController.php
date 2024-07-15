<?php
requiereAutenticacion();
requierePermiso("pacientes", "consultar");
require_once "models/Paciente.php";

$filtro = null;

if (!empty($_GET['filtro'])) {
    $filtro = substr($_GET['filtro'], 0, 1);
}

$pacientes = Paciente::filtrarPorLetra($filtro, 1);

renderView();