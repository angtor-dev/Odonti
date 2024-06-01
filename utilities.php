<?php
/**
 * Imprime la vista.
 * 
 * @param ?string $viewName Nombre de la vista, se usa por defecto el nombre del controlador actual
 * @param ?string $viewPath Ruta de vista, se usa por defecto la misma ruta que el controlador actual
 * @return void
 **/
function renderView(?string $viewName = null, ?string $viewPath = null) : void
{
    $viewName ??= $GLOBALS['controllerName'];
    $viewPath ??= $GLOBALS['controllerPath'];

    $viewName = ucfirst($viewName);
    $viewPath = ucfirst($viewPath);

    foreach ($GLOBALS as $key => $value) $$key = $value;
    
    $_layout ??= "Principal";

    if (!is_file("Views/".$viewPath.$viewName.".php")) {
        http_response_code(404);
        die("[Error] No se encontro la vista en <b>Views/".$viewPath.$viewName.".php</b>");
    }
    if (!is_file("Views/_Plantillas/".$_layout.".php")) {
        http_response_code(404);
        die("[Error] No se encontro la plantilla en <b>Views/_Plantillas/".$_layout.".php</b>");
    }

    try {
        ob_start('saveViewBuffer');
        require "Views/".$viewPath.$viewName.".php";
        ob_end_clean();
    } catch (\Throwable $th) {
        ob_end_clean();
        throw $th;
    }

    require "Views/_Plantillas/".$_layout.".php";
    exit;
}

/** 
 * Almacena el buffer de la vista que sera impresa
 * 
 * @param string $buffer Buffer a almacenar
 * @return string Cadena a imprimir luego de almacenar el buffer (Cadena vacia)
*/
function saveViewBuffer(string $buffer)
{
    $GLOBALS['view'] .= $buffer;
    return "";
}

/**
 * Valida si el usuario esta autenticado, de lo contrario se redirecciona al login
 */
function requiereAutenticacion() : void {
    if (!isset($_SESSION['usuario'])) {
        redirigir(LOCAL_DIR.'/Login');
    }
}

/**
 * Redirecciona de forma segura a una url
 * @param string $url Url a donde se redireccionará
 */
function redirigir($url) : void {
    header('location: '.$url);
    exit();
}

/**
* Alamecena el nombre de un script que sera utilizado en la vista
* @param string $scriptName Nombre del script (debe estar almacenado en public/js/)
*/
function agregarScript($scriptName) : void {
    global $viewScripts;

    $viewScripts[] = $scriptName;
}

/**
* Alamecena el nombre de un archivo css que sera utilizado en la vista
* @param string $styleName Nombre del archivo .css (debe estar almacenado en public/css/)
*/
function agregarCss($styleName) : void {
    global $viewStyles;

    $viewStyles[] = $styleName;
}

/**
 * Imprime el contenido de una variable en un formato legible
 * @param mixed $var variable a imprimir
 */
function debug(mixed $var) : void {
    echo "<pre>";
    print_r($var);
    echo "</pre>";
    exit;
}