<?php
require_once "Models/Model.php";

class Estudiante extends Model
{
    private int $idPaciente;
    private string $pnf;
    private int $trayecto;
    private int $fase;
    private string $seccion;
    private int $estado;

    public function registrar() : bool
    {
        $query = "INSERT INTO estudiante (idPaciente, pnf, trayecto, fase, seccion)
            VALUES (:idPaciente, :pnf, :trayecto, :fase, :seccion)";
            
        try {
            $this->ejecutar($query, $this->idPaciente, $this->pnf, $this->trayecto,
                $this->fase, $this->seccion);

            return true;
        } catch (\Throwable $th) {
            if (DEVELOPER_MODE) debug($th);
            return false;
        }
    }

    public function actualizar() : bool
    {
        $query = "UPDATE estudiante SET idPaciente = :idPaciente, pnf = :pnf,
            trayecto = :trayecto, fase = :fase, seccion = :seccion WHERE id = :id";
            
        try {
            $this->ejecutar($query, $this->idPaciente, $this->pnf, $this->trayecto,
                $this->fase, $this->seccion, $this->id);

            return true;
        } catch (\Throwable $th) {
            if (DEVELOPER_MODE) debug($th);
            return false;
        }
    }

    public function mapearFormulario() : bool
    {
        try {
            $this->idPaciente = $_POST['idPaciente'];
            $this->pnf = $_POST['pnf'];
            $this->trayecto = $_POST['trayecto'];
            $this->fase = $_POST['fase'];
            $this->seccion = $_POST['seccion'];
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
    public function getPnf() : string {
        return $this->pnf;
    }
    public function getTrayecto() : int {
        return $this->trayecto;
    }
    public function getFase() : int {
        return $this->fase;
    }
    public function getSeccion() : string {
        return $this->seccion;
    }
    public function getEstado() : int {
        return $this->estado;
    }
}