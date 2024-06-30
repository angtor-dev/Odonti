<?php
require_once "Models/Model.php";

class Cita extends Model
{
    private int $idPaciente;
    private int $idMedico;
    private string $fecha;
    private string $hora;
    private string $motivo;
    private string $observaciones;
    private int $estado;
    public ?Paciente $paciente;
    public ?Medico $medico;

    public function __construct()
    {
        parent::__construct();
        if (!empty($this->idPaciente)) {
            $this->paciente = Paciente::cargar($this->idPaciente);
        }
        if (!empty($this->idMedico)) {
            $this->medico = Medico::cargar($this->idMedico);
        }
    }
    public function registrar() : bool
    {
        $query = "INSERT INTO cita (idPaciente, idMedico, fecha, hora, motivo, observaciones)
            VALUES (:idPaciente, :idMedico, :fecha, :hora, :motivo, :observaciones)";
            
        try {
            $stmt = $this->prepare($query);
            $stmt->bindValue("idPaciente", $this->idPaciente);
            $stmt->bindValue("idMedico", $this->idMedico);
            $stmt->bindValue("fecha", $this->fecha);
            $stmt->bindValue("hora", $this->hora);
            $stmt->bindValue("motivo", $this->motivo);
            $stmt->bindValue("observaciones", $this->observaciones);

            $stmt->execute();

            return true;
        } catch (\Throwable $th) {
            $_SESSION['errores'][] = "Ocurrio un error al registrar la cita";
            return false;
        }
    }

    public function actualizar() : bool
    {
        $query = "UPDATE cita SET idPaciente = :idPaciente, idMedico = :idMedico,
            fecha = :fecha, hora = :hora, motivo = :motivo, observaciones = :observaciones
            WHERE id = :id";
            
        try {
            $stmt = $this->prepare($query);
            $stmt->bindValue("idPaciente", $this->idPaciente);
            $stmt->bindValue("idMedico", $this->idMedico);
            $stmt->bindValue("fecha", $this->fecha);
            $stmt->bindValue("hora", $this->hora);
            $stmt->bindValue("motivo", $this->motivo);
            $stmt->bindValue("observaciones", $this->observaciones);
            $stmt->bindValue("id", $this->id);

            $stmt->execute();

            return true;
        } catch (\Throwable $th) {
            $_SESSION['errores'][] = "Ha ocurrido un error al actualizar la cita.";
            return false;
        }
    }

    public function esValido() : bool
    {
        if (empty(trim($this->idPaciente))) {
            $_SESSION['errores'][] = "Debe especificar un paciente";
            return false;
        }
        if (empty(trim($this->idMedico))) {
            $_SESSION['errores'][] = "Debe especificar un medico";
            return false;
        }
        if (empty(trim($this->fecha))) {
            $_SESSION['errores'][] = "El campo 'Fecha' es obligatorio";
            return false;
        }
        if (empty(trim($this->hora))) {
            $_SESSION['errores'][] = "El campo 'Hora' es obligatorio";
            return false;
        }
        if (empty(trim($this->motivo))) {
            $_SESSION['errores'][] = "El campo 'Motivo' es obligatorio";
            return false;
        }
        if (!preg_match(REG_ALFANUMERICO, $this->motivo)) {
            $_SESSION['errores'][] = "El campo 'Motivo' solo puede contener letras y números";
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
            $this->hora = $_POST['hora'];
            $this->motivo = $_POST['motivo'];
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
    public function getIdPaciente() : int {
        return $this->idPaciente;
    }
    public function getIdMedico() : int {
        return $this->idMedico;
    }
    public function getFecha() : string {
        return $this->fecha;
    }
    public function getHora() : string {
        return $this->hora;
    }
    public function getMotivo() : string {
        return $this->motivo;
    }
    public function getObservaciones() : string {
        return $this->observaciones;
    }
}