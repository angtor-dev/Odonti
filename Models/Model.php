<?php
require_once "Models/Database.php";

abstract class Model
{
    public int $id;
    protected Database $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    /**
     * Retorna un array de objetos del modelo que lo instacía
     *
     * @param int|null $estado Si no se especifica, retorna todas las filas de la tabla.
     * Si se especifica, retorna las filas donde el estado sea igual al indicado.
     * @return array<self>
     **/
    public static function listar(int $estado = null): array
    {
        $bd = Database::getInstance();
        $table = strtolower(static::class);
        $query = "SELECT * FROM $table" . (isset($estado) ? " WHERE estado = $estado" : "");

        $stmt = $bd->pdo()->query($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS, $table);

        return $stmt->fetchAll();
    }

    /** Shorthand para PDO::query() */
    protected function query(string $query): PDOStatement
    {
        return $this->db->pdo()->query($query);
    }

    /** Shorthand para PDO::prepare() */
    protected function prepare(string $query): PDOStatement
    {
        return $this->db->pdo()->prepare($query);
    }
}