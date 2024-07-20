<?php
requiereAutenticacion();
requierePermiso("categorias", "eliminar");
require_once "Models/Categoria.php";

$categoria = Categoria::cargar($_GET['id']);

if (empty($categoria)) {
    $_SESSION['errores'][] = "La categoria que intenta eliminar no existe";
    redirigir(LOCAL_DIR."/Categorias");
}

if ($categoria->eliminar()) {
    $_SESSION['exitos'][] = "Categoria eliminada con exito";
    Bitacora::registrar("Categoria '".$categoria->getNombre()."' eliminada");
}

redirigir(LOCAL_DIR."/Categorias");