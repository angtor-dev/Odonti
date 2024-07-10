<?php
requiereAutenticacion();
requierePermiso("servicios", "eliminar");
require_once "Models/Servicio.php";

$servicio = Servicio::cargar($_GET['id']);

if (empty($servicio)) {
    $_SESSION['errores'][] = "El servicio que intenta eliminar no existe";
    redirigir(LOCAL_DIR."/Servicios");
}

if ($servicio->eliminar()) {
    $_SESSION['exitos'][] = "Servicio eliminado con exito";
    Bitacora::registrar("Servicio '".$servicio->getNombre()."' eliminado");
}

redirigir(LOCAL_DIR."/Servicios");