<?php
require_once "Models/Model.php";
require_once "Models/Consulta.php";

class Recibo extends Model
{
    private int $idConsulta;
    private string $fecha;
    private float $monto;
    private float $descuento;

    public function registrar() : bool
    {
        $query = "INSERT INTO recibo (idConsulta, monto, descuento)
            VALUES (:idConsulta, :monto, :descuento)";
            
        try {
            $this->ejecutar($query, $this->idConsulta, $this->monto, $this->descuento);

            return true;
        } catch (\Throwable $th) {
            $_SESSION['errores'][] = "Ocurrio un error al registrar el recibo";
            return false;
        }
    }

    public function actualizar() : bool
    {
        $query = "UPDATE recibo SET idConsulta = :idConsulta, monto = :monto,
            descuento = :descuento WHERE id = :id";
            
        try {
            $this->ejecutar($query, $this->idConsulta, $this->monto, $this->descuento, $this->id);

            return true;
        } catch (\Throwable $th) {
            $_SESSION['errores'][] = "Ha ocurrido un error al actualizar el recibo.";
            return false;
        }
    }

    public function esValido() : bool
    {
        if (empty($this->idConsulta)) {
            $_SESSION['errores'][] = "El recibo debe pertenercer a una consulta.";
            return false;
        }
        if (empty($this->monto) || $this->monto < 0) {
            $_SESSION['errores'][] = "Se debe establecer un monto para el recibo.";
            return false;
        }
        if (empty($this->monto) || $this->descuento < 0) {
            $_SESSION['errores'][] = "El descuento no puede ser negativo.";
            return false;
        }
        return true;
    }

    public function mapearFormulario() : bool
    {
        try {
            $this->idConsulta = $_POST['idConsulta'];
            $this->monto = $_POST['monto'];
            $this->descuento = $_POST['descuento'];
            if (!empty($_POST['id'])) {
                $this->id = $_POST['id'];
            }

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    // Getters
    public function getIdConsulta() : int {
        return $this->idConsulta;
    }
    public function getFecha() : string {
        return $this->fecha;
    }
    public function getMonto() : float {
        return $this->monto;
    }
    public function getDescuento() : float {
        return $this->descuento;
    }
}