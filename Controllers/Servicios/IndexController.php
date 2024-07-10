<?php
requiereAutenticacion();
requierePermiso("servicios", "consultar");
require_once "Models/Servicio.php";

$servicios = Servicio::listar(1);

renderView();