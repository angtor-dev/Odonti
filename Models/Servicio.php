<?php
require_once "Models/Model.php";

class Servicio extends Model
{
    private string $nombre;
    private string $descripcion;
    private float $costo;

    public function registrar() : bool
    {
        $query = "INSERT INTO servicio (nombre, descripcion, costo)
            VALUES (:nombre, :descripcion, :costo)";
            
        try {
            $this->db->connect();

            $stmt = $this->prepare($query);
            $stmt->bindValue("nombre", $this->nombre);
            $stmt->bindValue("descripcion", $this->descripcion);
            $stmt->bindValue("costo", $this->costo);

            $stmt->execute();
            
            $this->db->disconnect();

            return true;
        } catch (\Throwable $th) {
            $_SESSION['errores'][] = "Ocurrio un error al registrar el servicio";
            return false;
        }
    }

    public function actualizar() : bool
    {
        $query = "UPDATE servicio SET nombre = :nombre, descripcion = :descripcion
            WHERE id = :id";
            
        try {
            $this->db->connect();

            $stmt = $this->prepare($query);
            $stmt->bindValue("nombre", $this->nombre);
            $stmt->bindValue("descripcion", $this->descripcion);
            $stmt->bindValue("costo", $this->costo);
            $stmt->bindValue("id", $this->id);

            $stmt->execute();
            
            $this->db->disconnect();

            return true;
        } catch (\Throwable $th) {
            $_SESSION['errores'][] = "Ha ocurrido un error al actualizar el servicio.";
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
        if (empty($this->costo) || $this->costo < 0) {
            $_SESSION['errores'][] = "El campo 'Costo' debe ser mayor que 0";
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
    public function getCosto() : float {
        return $this->costo;
    }
}