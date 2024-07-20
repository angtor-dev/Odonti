<?php
requiereAutenticacion();
requierePermiso("consultas", "actualizar");
require_once "models/Consulta.php";
require_once "models/Recibo.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    /** @var Consulta */
    $consulta = Consulta::cargar($_POST['id']);
    $recibo = new Recibo();
    $monto = 0;
    $fecha = date('Y-m-d');
    $descuento = ($consulta->paciente->esEstudiante()) ? 100 : 0;

    foreach ($consulta->servicios as $servicio) {
        $monto += $servicio->getCosto();
    }

    $recibo->setDatos($consulta->id, $fecha, $monto, $descuento);
    $recibo->registrar();
    $_SESSION['exitos'][] = "Consulta procesada con exito";

    redirigir(LOCAL_DIR."/Consultas");
}
else
{
    http_response_code(405);
    exit;
}