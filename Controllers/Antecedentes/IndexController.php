<?php
requiereAutenticacion();
requierePermiso("antecedentes", "consultar");
require_once "Models/Antecedente.php";

$antecedentes = Antecedente::listar(1);

renderView();