<?php
require_once "Models/Model.php";

class Estudiante extends Model
{
    public int $idRol;
    private string $pnf;
    private string $nombre;
    private string $apellido;
    private string $correo;
    private int $estado;
    private string $clave;

    public function registrar() : bool
    {
        $query = "INSERT INTO usuario (idRol, nombre, apellido, correo, clave)
            VALUES (:idRol, :nombre, :apellido, :correo, :clave)";
            
        try {
            $stmt = $this->prepare($query);
            $stmt->bindValue("idRol", $this->idRol);
            $stmt->bindValue("nombre", $this->nombre);
            $stmt->bindValue("apellido", $this->apellido);
            $stmt->bindValue("correo", $this->correo);
            $stmt->bindValue("clave", password_hash($this->clave, PASSWORD_DEFAULT));

            $stmt->execute();

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function actualizar() : bool
    {
        $query = "UPDATE usuario SET idRol = :idRol, nombre = :nombre,
            apellido = :apellido, correo = :correo WHERE id = :id";
            
        try {
            $stmt = $this->prepare($query);
            $stmt->bindValue("idRol", $this->idRol);
            $stmt->bindValue("nombre", $this->nombre);
            $stmt->bindValue("apellido", $this->apellido);
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
            $this->idRol = $_POST['idRol'];
            $this->nombre = $_POST['nombre'];
            $this->apellido = $_POST['apellido'];
            $this->correo = $_POST['correo'];
            if (!empty($_POST['id'])) {
                $this->id = $_POST['id'];
            } else {
                $this->clave = $_POST['clave'];
            }

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    // Getters
    public function getNombreCompleto() : string {
        return $this->nombre." ".$this->apellido;
    }
    
    public function getCorreo() : string {
        return $this->correo;
    }
    public function getNombre() : string {
        return $this->nombre;
    }
    public function getApellido() : string {
        return $this->apellido;
    }
    public function getEstado() : int {
        return $this->estado;
    }
}