<?php
require_once "Models/Model.php";
require_once "Models/Paciente.php";
require_once "Models/Medico.php";
require_once "Models/Servicio.php";

class Consulta extends Model
{
    private ?int $idPaciente;
    private ?int $idMedico;
    private ?string $fecha;
    private ?string $hora;
    private string $observaciones;
    private int $estado;
    public ?Paciente $paciente;
    public ?Medico $medico;
    /** @var Servicio[] */
    public array $servicios;

    public function __construct()
    {
        parent::__construct();
        if (!empty($this->idPaciente)) {
            $this->paciente = Paciente::cargar($this->idPaciente);
        }
        if (!empty($this->idMedico)) {
            $this->medico = Medico::cargar($this->idMedico);
        }
        if (!empty($this->id)) {
            $this->servicios = Servicio::listarPorRelacionIntermedia($this->id,
                get_class(), "consultaservicio");
        }
    }

    /** @return self[] */
    public static function listarPorPaciente(int $idPaciente) : array
    {
        return Consulta::listarPorRelacion($idPaciente, "Paciente");
    }

    public function registrar() : Consulta|null
    {
        $query = "INSERT INTO consulta (idPaciente, idMedico, fecha, hora, observaciones)
            VALUES (:idPaciente, :idMedico, :fecha, :hora, :observaciones)";
            
        try {
            $this->db->connect();

            $stmt = $this->prepare($query);

            $stmt->bindParam("idPaciente", $this->idPaciente);
            $stmt->bindParam("idMedico", $this->idMedico);
            $stmt->bindParam("fecha", $this->fecha);
            $stmt->bindParam("hora", $this->hora);
            $stmt->bindParam("observaciones", $this->observaciones);

            $stmt->execute();

            $lastId = $this->db->pdo()->lastInsertId();

            $this->db->disconnect();

            $consulta = Consulta::cargar($lastId);

            return $consulta;
        } catch (\Throwable $th) {
            $_SESSION['errores'][] = "Ocurrio un error al registrar la consulta";
            return null;
        }
    }

    public function actualizar() : bool
    {
        $query = "UPDATE consulta SET idPaciente = :idPaciente, idMedico = :idMedico,
            fecha = :fecha, hora = :hora, observaciones = :observaciones
            WHERE id = :id";
            
        try {
            $this->ejecutar($query, $this->idPaciente, $this->idMedico, $this->fecha,
                $this->hora, $this->observaciones, $this->id);

            return true;
        } catch (\Throwable $th) {
            $_SESSION['errores'][] = "Ha ocurrido un error al actualizar la consulta.";
            return false;
        }
    }

    public function agregarServicio(int $idServicio) : bool
    {
        $query = "INSERT INTO consultaservicio (idConsulta, idServicio) VALUES (:id, :idServicio)";
            
        try {
            $this->ejecutar($query, $this->id, $idServicio);

            return true;
        } catch (\Throwable $th) {
            $_SESSION['errores'][] = "Ha ocurrido un error al eliminar el servicio de la consulta.";
            return false;
        }
    }

    public function eliminarServicio(int $idServicio) : bool
    {
        $query = "DELETE FROM consultaservicio WHERE idConsulta = :id AND idServicio = :idServicio LIMIT 1";
            
        try {
            $this->ejecutar($query, $this->id, $idServicio);

            return true;
        } catch (\Throwable $th) {
            $_SESSION['errores'][] = "Ha ocurrido un error al eliminar el servicio de la consulta.";
            return false;
        }
    }

    public function esValido() : bool
    {
        if (!empty($this->id) && empty(trim($this->idPaciente))) {
            $_SESSION['errores'][] = "Debe especificar un paciente";
            return false;
        }
        if (!empty($this->id) && empty(trim($this->idMedico))) {
            $_SESSION['errores'][] = "Debe especificar un medico";
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
            $this->idPaciente = $_POST['idPaciente'];
            $this->idMedico = $_POST['idMedico'];
            $this->fecha = $_POST['fecha'];
            $this->fecha = $_POST['hora'];
            $this->observaciones = $_POST['observaciones'];
            if (!empty($_POST['id'])) {
                $this->id = $_POST['id'];
            }

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    // Setters
    public function setDatos(string $fecha, string $hora, string $observaciones) : void {
        $this->idPaciente = null;
        $this->idMedico = null;
        $this->fecha = $fecha;
        $this->fecha = $hora;
        $this->observaciones = $observaciones;
    }

    // Getters
    public function getIdPaciente() : int {
        return $this->idPaciente;
    }
    public function getIdMedico() : int {
        return $this->idMedico;
    }
    public function getFecha() : string {
        return $this->fecha ?? "";
    }
    public function getHora() : string {
        return $this->hora ?? "";
    }
    public function getObservaciones() : string {
        return $this->observaciones;
    }
}