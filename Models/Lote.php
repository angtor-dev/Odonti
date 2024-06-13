<?php
require_once "Models/Model.php";
require_once "Models/Insumo.php";

class Lote extends Model
{
    private int $idInsumo;
    private string $fechaIngreso;
    private ?string $fechaVencimiento;
    private int $inicial;
    private int $cantidad;

    public function registrar() : bool
    {
        $query = "INSERT INTO lote (idInsumo, fechaIngreso, fechaVencimiento, inicial, cantidad)
            VALUES (:idInsumo, :fechaIngreso, :fechaVencimiento, inicial, :cantidad)";
            
        try {
            $stmt = $this->prepare($query);
            $stmt->bindValue("idInsumo", $this->idInsumo);
            $stmt->bindValue("fechaIngreso", $this->fechaIngreso);
            $stmt->bindValue("fechaVencimiento", $this->fechaVencimiento);
            $stmt->bindValue("inicial", $this->inicial);
            $stmt->bindValue("cantidad", $this->cantidad);

            $stmt->execute();

            return true;
        } catch (\Throwable $th) {
            $_SESSION['errores'][] = "Ocurrio un error al registrar el lote";
            return false;
        }
    }

    public function actualizar() : bool
    {
        $query = "UPDATE lote SET idInsumo = :idInsumo, fechaIngreso = :fechaIngreso,
            fechaVencimiento = :fechaVencimiento, inicial = :inicial, cantidad = :cantidad
            WHERE id = :id";
            
        try {
            $stmt = $this->prepare($query);
            $stmt->bindValue("idInsumo", $this->idInsumo);
            $stmt->bindValue("fechaIngreso", $this->fechaIngreso);
            $stmt->bindValue("fechaVencimiento", $this->fechaVencimiento);
            $stmt->bindValue("inicial", $this->inicial);
            $stmt->bindValue("cantidad", $this->cantidad);
            $stmt->bindValue("id", $this->id);

            $stmt->execute();

            return true;
        } catch (\Throwable $th) {
            $_SESSION['errores'][] = "Ha ocurrido un error al actualizar el lote.";
            return false;
        }
    }

    public function esValido() : bool
    {
        // Implemetar
        return true;
    }

    public function mapearFormulario() : bool
    {
        try {
            $this->idInsumo = $_POST['idInsumo'];
            $this->fechaIngreso = $_POST['fechaIngreso'];
            $this->fechaVencimiento = $_POST['fechaVencimiento'];
            $this->inicial = $_POST['inicial'];
            $this->cantidad = $_POST['cantidad'];
            if (!empty($_POST['id'])) {
                $this->id = $_POST['id'];
            }

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    // Getters
    public function getIdInsumo() : int {
        return $this->idInsumo;
    }
    public function getFechaIngreso() : string {
        return $this->fechaIngreso;
    }
    public function getFechaVencimiento() : null|string {
        return $this->fechaVencimiento;
    }
    public function getInicial() : int {
        return $this->inicial;
    }
    public function getCantidad() : int {
        return $this->cantidad;
    }
}