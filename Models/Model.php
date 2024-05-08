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