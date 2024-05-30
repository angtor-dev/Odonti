<?php
require_once "Models/Model.php";

class Rol extends Model
{
    public int $id;
    public string $nombre;
    public ?string $descripcion;
}