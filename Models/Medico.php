<?php
require_once "Models/Model.php";

class Medico extends Model
{
    // public int $idRol;
    private string $cedula;
    private string $nombre;
    private string $apellido;
    private string $direccion;
    private string $telefono;
    private string $correo;
    private int $estado;

    public function registrar() : bool
    {
        $query = "INSERT INTO medico (cedula, nombre, apellido, direccion, telefono, correo)
            VALUES (:cedula, :nombre, :apellido, :direccion, :telefono, :correo)";
            
        try {
            $stmt = $this->prepare($query);
            $stmt->bindValue("cedula", $this->cedula);
            $stmt->bindValue("nombre", $this->nombre);
            $stmt->bindValue("apellido", $this->apellido);
            $stmt->bindValue("direccion", $this->direccion);
            $stmt->bindValue("telefono", $this->telefono);
            $stmt->bindValue("correo", $this->correo);

            $stmt->execute();

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function actualizar() : bool
    {
        $query = "UPDATE medico SET cedula = :cedula, nombre = :nombre,
            apellido = :apellido, direccion = :direccion, telefono = :telefono, correo = :correo WHERE id = :id";
            
        try {
            $stmt = $this->prepare($query);
            $stmt->bindValue("cedula", $this->cedula);
            $stmt->bindValue("nombre", $this->nombre);
            $stmt->bindValue("apellido", $this->apellido);
            $stmt->bindValue("direccion", $this->direccion);
            $stmt->bindValue("telefono", $this->telefono);
            $stmt->bindValue("correo", $this->correo);
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
            $this->direccion = $_POST['direccion'];
            $this->telefono = $_POST['telefono'];
            $this->correo = $_POST['correo'];
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
    
    public function getDirecion() : string {
        return $this->direccion;
    }
    public function getTelefono() : string {
        return $this->telefono;
    }
    public function getCorreo() : string {
        return $this->correo;
    }
    public function getEstado() : int {
        return $this->estado;
    }
}