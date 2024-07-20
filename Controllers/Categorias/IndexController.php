<?php
requiereAutenticacion();
requierePermiso("categorias", "consultar");
require_once "Models/Categoria.php";

$categorias = Categoria::listar(1);

renderView();