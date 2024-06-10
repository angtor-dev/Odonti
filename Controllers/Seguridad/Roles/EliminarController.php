<?php
requiereAutenticacion();

$rol = Rol::cargar($_GET['id']);

if (empty($rol)) {
    $_SESSION['errores'][] = "El rol que intenta eliminar no existe";
    redirigir(LOCAL_DIR."/Seguridad/Roles");
}

$usuarios = Usuario::listarPorRol($rol->id, 1);

if (count($usuarios) > 0) {
    $_SESSION['errores'][] = "Existen usuarios con el rol '".$rol->getNombre(). 
        "' asignado. Asegurate de asignarles otro rol antes de eliminarlo.";
    redirigir(LOCAL_DIR."/Seguridad/Roles");
}

if ($rol->eliminar()) {
    $_SESSION['exitos'][] = "Rol eliminado con exito";
}

redirigir(LOCAL_DIR."/Seguridad/Roles");