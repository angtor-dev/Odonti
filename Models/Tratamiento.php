<?php
require_once "Models/Model.php";

class Tratamiento extends Model
{
    private string $nombre;
    private string $descripcion;

    public function registrar() : bool
    {
        $query = "INSERT INTO tratamiento (nombre, descripcion)
            VALUES (:nombre, :descripcion)";
            
        try {
            $stmt = $this->prepare($query);
            $stmt->bindValue("nombre", $this->nombre);
            $stmt->bindValue("descripcion", $this->descripcion);

            $stmt->execute();

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function actualizar() : bool
    {
        $query = "UPDATE tratamiento SET nombre = :nombre, descripcion = :descripcion
            WHERE id = :id";
            
        try {
            $stmt = $this->prepare($query);
            $stmt->bindValue("nombre", $this->nombre);
            $stmt->bindValue("descripcion", $this->descripcion);
            $stmt->bindValue("id", $this->id);

            $stmt->execute();

            return true;
        } catch (\Throwable $th) {
            $_SESSION['errores'][] = "Ha ocurrido un error al actualizar el tratamiento.";
            return false;
        }
    }

    public function mapearFormulario() : bool
    {
        try {
            $this->nombre = $_POST['nombre'];
            $this->descripcion = $_POST['descripcion'];
            if (!empty($_POST['id'])) {
                $this->id = $_POST['id'];
            }

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    // Getters
    public function getNombre() : string {
        return $this->nombre;
    }
    public function getDescripcion() : string {
        return $this->descripcion;
    }
}