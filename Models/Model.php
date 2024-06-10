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
     * Retorna una instacia del modelo actual con un id especifico
     * 
     * @param int $id El id a buscar en la bd
     * @return null|self El modelo encontrado o null en caso de no haber coincidencias
     */
    public static function cargar(int $id) : null|self
    {
        $bd = Database::getInstance();
        $table = strtolower(static::class);
        $query = "SELECT * FROM $table WHERE id = $id";

        $stmt = $bd->pdo()->query($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS, $table);

        if ($stmt->rowCount() == 0) {
            return null;
        }
        return $stmt->fetch();
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

    /**
     * Retorna un array de objetos del modelo que lo instacía donde el id de la tabla
     * foranea coincida con el id del modelo
     * 
     * @param int $id El id del modelo actual
     * @param string $tablaForanea El nombre de la tabla con la que se relaciona el modelo
     * @param int|null $estatus Si se especifica, retorna las filas donde el estatus sea igual al indicado.
     * @return self[]
     */
    public static function listarPorRelacion(int $id, string $tablaForanea, int $estatus = null) : array
    {
        $bd = Database::getInstance();
        $table = strtolower(static::class);
        $query = "SELECT * FROM $table WHERE id$tablaForanea = $id" . (isset($estatus) ? " AND estatus = $estatus" : "");

        $stmt = $bd->pdo()->query($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS, $table);

        if ($stmt->rowCount() == 0) {
            return array();
        }
        return $stmt->fetchAll();
    }

    /**
     * Elimina u oculta la instancia actual en la BD
     * 
     * @param bool $eliminadoLogico Si es true oculta la instancia en la BD (UPDATE estado = 0),
     * caso contrario elimina la instancia de la BD (DELETE FROM)
     */
    public function eliminar(bool $eliminadoLogico = true) : bool
    {
        $tabla = strtolower(get_class($this));
        $query = $eliminadoLogico
            ? "UPDATE $tabla set estado = 0 WHERE id = :id"
            : "DELETE FROM $tabla WHERE id = :id";

        try {
            $stmt = $this->prepare($query);
            $stmt->bindValue('id', $this->id);

            $stmt->execute();

            return true;
        } catch (\Throwable $th) {
            if (DEVELOPER_MODE) var_dump($th); // Eliminar esto al crear vista para errores
            $_SESSION['errores'][] = "Ha ocurrido un error al eliminar $tabla.";
            return false;
        }
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