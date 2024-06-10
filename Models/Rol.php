<?php
require_once "Models/Model.php";

class Rol extends Model
{
    private string $nombre;
    private ?string $descripcion;

    // Getters
    public function getNombre() : string {
        return $this->nombre;
    }
    public function getDescripcion() : string {
        return $this->descripcion;
    }
}