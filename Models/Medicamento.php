<?php
require_once "Models/Model.php";

class Medicamento extends Model
{
    private string $nombre;
    private string $descripcion;
    private int $estado;

    public function registrar() : bool
    {
        $query = "INSERT INTO medicamento (nombre, descripcion)
            VALUES (:nombre, :descripcion)";
            
        try {
            $this->ejecutar($query, $this->nombre, $this->descripcion);

            return true;
        } catch (\Throwable $th) {
            $_SESSION['errores'][] = "Ocurrio un error al registrar el medicamento";
            return false;
        }
    }

    public function actualizar() : bool
    {
        $query = "UPDATE medicamento SET nombre = :nombre, descripcion = :descripcion
            WHERE id = :id";
            
        try {
            $this->ejecutar($query, $this->nombre, $this->descripcion, $this->id);

            return true;
        } catch (\Throwable $th) {
            $_SESSION['errores'][] = "Ha ocurrido un error al actualizar el medicamento.";
            return false;
        }
    }

    public function esValido() : bool
    {
        if (empty(trim($this->nombre))) {
            $_SESSION['errores'][] = "El campo 'Nombre' es obligatorio";
            return false;
        }
        if (!preg_match(REG_ALFANUMERICO, $this->nombre)) {
            $_SESSION['errores'][] = "El campo 'Nombre' solo puede contener letras y números";
            return false;
        }
        if (!preg_match(REG_ALFANUMERICO, $this->descripcion)) {
            $_SESSION['errores'][] = "El campo 'Descripcion' solo puede contener letras y números";
            return false;
        }
        return true;
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
    public function getEstado() : int {
        return $this->estado;
    }
}