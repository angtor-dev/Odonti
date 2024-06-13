<?php
require_once "Models/Model.php";

class Paciente extends Model
{
    // public int $idRol;
    private string $cedula;
    private string $nombre;
    private string $apellido;
    private string $genero;
    private string $fechaNacimiento;
    private string $direccion;
    private int $estado;

    public function registrar() : bool
    {
        $query = "INSERT INTO paciente (cedula, nombre, apellido, genero, fechaNacimiento, direccion)
            VALUES (:cedula, :nombre, :apellido, :genero, :fechaNacimiento, :direccion)";
            
        try {
            $stmt = $this->prepare($query);
            $stmt->bindValue("cedula", $this->cedula);
            $stmt->bindValue("nombre", $this->nombre);
            $stmt->bindValue("apellido", $this->apellido);
            $stmt->bindValue("genero", $this->genero);
            $stmt->bindValue("fechaNacimiento", $this->fechaNacimiento);
            $stmt->bindValue("direccion", $this->direccion);

            $stmt->execute();

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function actualizar() : bool
    {
        $query = "UPDATE paciente SET cedula = :cedula, nombre = :nombre,
            apellido = :apellido, genero = :genero, fechaNacimiento = :fechaNacimiento, direccion = :direccion WHERE id = :id";
            
        try {
            $stmt = $this->prepare($query);
            $stmt->bindValue("cedula", $this->cedula);
            $stmt->bindValue("nombre", $this->nombre);
            $stmt->bindValue("apellido", $this->apellido);
            $stmt->bindValue("genero", $this->genero);
            $stmt->bindValue("fechaNacimiento", $this->fechaNacimiento);
            $stmt->bindValue("direccion", $this->direccion);
            $stmt->bindValue("id", $this->id);

            $stmt->execute();

            return true;
        } catch (\Throwable $th) {
            if (DEVELOPER_MODE) debug($th);
            return false;
        }
    }

    public function mapearFormulario() : bool
    {
        try {
            $this->cedula = $_POST['cedula'];
            $this->nombre = $_POST['nombre'];
            $this->apellido = $_POST['apellido'];
            $this->genero = $_POST['genero'];
            $this->fechaNacimiento = $_POST['fechaNacimiento'];
            $this->direccion = $_POST['direccion'];
            if (!empty($_POST['id'])) {
                $this->id = $_POST['id'];
            }

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    // Getters
    public function getCedula() : string {
        return $this->cedula;
    }
    public function getNombreCompleto() : string {
        return $this->nombre." ".$this->apellido;
    }
    public function getNombre() : string {
        return $this->nombre;
    }
    public function getApellido() : string {
        return $this->apellido;
    }
    
    public function getGenero() : string {
        return $this->genero;
    }
    public function getFechaNacimiento() : string {
        return $this->fechaNacimiento;
    }
    public function getDireccion() : string {
        return $this->direccion;
    }
    public function getEstado() : int {
        return $this->estado;
    }
}