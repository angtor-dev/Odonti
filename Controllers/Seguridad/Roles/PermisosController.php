<?php
requiereAutenticacion();
requierePermiso("permisos", "consultar");

$rol = Rol::cargar($_GET['id']);
$permisos = Permiso::listarPorRelacion($rol->id, "Rol");
$modulos = Modulo::listar();

renderComponent("_ModalPermisos");