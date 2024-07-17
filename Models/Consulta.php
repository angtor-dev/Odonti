<?php
require_once "Models/Model.php";
require_once "Models/Cita.php";
require_once "Models/Servicio.php";

class Consulta extends Model
{
    private int $idCita;
    private string $fecha;
    private string $observaciones;
    private int $estado;
    public ?Cita $cita;
    /** @var Servicio[] */
    public array $servicios;

    public function __construct()
    {
        parent::__construct();
        if (!empty($this->idCita)) {
            $this->cita = Cita::cargar($this->idCita);
        }
        if (!empty($this->id)) {
            $this->servicios = Servicio::listarPorRelacionIntermedia($this->id,
                get_class(), "consultaservicio");
        }
    }

    /** @return self[] */
    public static function listarPorPaciente(int $idPaciente) : array
    {
        $consultasDelPaciente = [];
        /** @var Consulta[] */
        $consultas = Consulta::listar(1);

        foreach ($consultas as $consulta) {
            if ($consulta->cita->getIdPaciente() == $idPaciente) {
                $consultasDelPaciente[] = $consulta;
            }
        }

        return $consultasDelPaciente;
    }

    public function registrar() : bool
    {
        $query = "INSERT INTO consulta (idCita, fecha, observaciones)
            VALUES (:idCita, :fecha, :observaciones)";
            
        try {
            $this->ejecutar($query, $this->idCita, $this->fecha, $this->observaciones);

            return true;
        } catch (\Throwable $th) {
            $_SESSION['errores'][] = "Ocurrio un error al registrar la consulta";
            return false;
        }
    }

    public function actualizar() : bool
    {
        $query = "UPDATE consulta SET idCita = :idCita, fecha = :fecha,
            observaciones = :observaciones
            WHERE id = :id";
            
        try {
            $this->ejecutar($query, $this->idCita, $this->fecha, $this->observaciones, $this->id);

            return true;
        } catch (\Throwable $th) {
            $_SESSION['errores'][] = "Ha ocurrido un error al actualizar la consulta.";
            return false;
        }
    }

    public function esValido() : bool
    {
        if (empty(trim($this->idCita))) {
            $_SESSION['errores'][] = "Debe especificar una cita";
            return false;
        }
        if (empty(trim($this->fecha))) {
            $_SESSION['errores'][] = "El campo 'Fecha' es obligatorio";
            return false;
        }
        if (empty(trim($this->observaciones))) {
            $_SESSION['errores'][] = "El campo 'observaciones' es obligatorio";
            return false;
        }
        if (!preg_match(REG_ALFANUMERICO, $this->observaciones)) {
            $_SESSION['errores'][] = "El campo 'Observaciones' solo puede contener letras y números";
            return false;
        }
        return true;
    }

    public function mapearFormulario() : bool
    {
        try {
            $this->idCita = $_POST['idCita'];
            $this->fecha = $_POST['fecha'];
            $this->observaciones = $_POST['observaciones'];
            if (!empty($_POST['id'])) {
                $this->id = $_POST['id'];
            }

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    // Getters
    public function getIdCita() : int {
        return $this->idCita;
    }
    public function getFecha() : string {
        return $this->fecha;
    }
    public function getObservaciones() : string {
        return $this->observaciones;
    }
}