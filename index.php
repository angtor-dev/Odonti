<?php
if (file_exists("user_config.php"))
    require_once "user_config.php";
require_once "config.php";
require_once "utilities.php";
require_once "Models/Usuario.php";
session_start();

$defaultController = "Index";
$defaultPath = "Home/";

// Carpeta relativa actual del proyecto
$relativePath = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'], "index.php"));
// Elimina la ruta del proyecto, los parametro y el ultimo "/"
$requestUri = substr($_SERVER['REQUEST_URI'], strlen($relativePath));
$requestUri = substr($requestUri, 0, strpos($requestUri, '?') === false ? strlen($requestUri) : strpos($requestUri, '?'));
$requestUri = rtrim($requestUri, "/");
// Divide la ruta en partes
$uriParts = explode('/', $requestUri);

$controllerName = count($uriParts) > 1 ? $uriParts[count($uriParts) - 1] : $defaultController;
$controllerPath = empty($requestUri) ? $defaultPath :
    (substr($requestUri, 0, strpos($requestUri, $controllerName)) ?: $requestUri."/");

if (is_file("Controllers/".$controllerPath.$controllerName."Controller.php")) {
    require_once "Controllers/".ucfirst($controllerPath).ucfirst($controllerName)."Controller.php";
    exit();
} else {
    // TODO: usar otras variables para mantener historial de ruta visitada
    $controllerPath .= $controllerName."/";
    $controllerName = "Index";
    if (is_file("Controllers/".ucfirst($controllerPath).$controllerName."Controller.php")) {
        require_once "Controllers/".ucfirst($controllerPath).$controllerName."Controller.php";
        exit();
    }
}

http_response_code(404);
if (DEVELOPER_MODE) {
    // TODO: crear vista para imprimir errores de desarrollador
    die("<font face=consolas><b>[Error]</b> El controlador <b>".$controllerName."</b> en <b>".$controllerPath."</b> no existe</font>");
}
// TODO: Crear vista generica para errores