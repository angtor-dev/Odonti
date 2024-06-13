<?php
require_once "Models/Model.php";

class Insumo extends Model
{
    private string $descripcion;
    private ?string $codigo;
    private int $cantidad;

    public function __construct() {
        parent::__construct();
        if (!empty($this->id)) {
            $this->cantidad = $this->obtenerCantidad();
        }
    }

    public function registrar() : bool
    {
        $query = "INSERT INTO insumo (codigo, descripcion)
            VALUES (:codigo, :descripcion)";
            
        try {
            $stmt = $this->prepare($query);
            $stmt->bindValue("codigo", $this->codigo);
            $stmt->bindValue("descripcion", $this->descripcion);

            $stmt->execute();

            return true;
        } catch (\Throwable $th) {
            $_SESSION['errores'][] = "Ocurrio un error al registrar el insumo";
            return false;
        }
    }

    public function actualizar() : bool
    {
        $query = "UPDATE insumo SET descripcion = :descripcion, codigo = :codigo
            WHERE id = :id";
            
        try {
            $stmt = $this->prepare($query);
            $stmt->bindValue("descripcion", $this->descripcion);
            $stmt->bindValue("codigo", $this->codigo ?? "");
            $stmt->bindValue("id", $this->id);

            $stmt->execute();

            return true;
        } catch (\Throwable $th) {
            debug($th);
            $_SESSION['errores'][] = "Ha ocurrido un error al actualizar el insumo.";
            return false;
        }
    }

    public function esValido() : bool
    {
        if (empty(trim($this->descripcion))) {
            $_SESSION['errores'][] = "El campo 'Descripcion' es obligatorio";
            return false;
        }
        if (!preg_match(REG_ALFANUMERICO, $this->descripcion)) {
            $_SESSION['errores'][] = "El campo 'Descripcion' solo puede contener letras y números";
            return false;
        }
        if (!preg_match(REG_ALFANUMERICO, $this->codigo)) {
            $_SESSION['errores'][] = "El campo 'Codigo' solo puede contener letras y números";
            return false;
        }
        return true;
    }

    public function mapearFormulario() : bool
    {
        try {
            $this->descripcion = $_POST['descripcion'];
            $this->codigo = $_POST['codigo'];
            if (!empty($_POST['id'])) {
                $this->id = $_POST['id'];
            }

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    private function obtenerCantidad() : int
    {
        $query = "SELECT sum(cantidad) AS 'cantidad' FROM lote WHERE idInsumo = $this->id";
        $stmt = $this->query($query);

        $cantidad = $stmt->fetchColumn(0);

        if ($cantidad > 0) {
            return $cantidad;
        }
        return 0;
    }

    // Getters
    public function getDescripcion() : string {
        return $this->descripcion;
    }
    public function getCodigo() : string {
        return $this->codigo ?? "";
    }
    public function getCantidad() : int {
        return $this->cantidad;
    }
}