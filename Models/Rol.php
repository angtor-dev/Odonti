<?php
require_once "Models/Model.php";
require_once "Models/Modulo.php";
require_once "Models/Permiso.php";

class Rol extends Model
{
    private string $nombre;
    private ?string $descripcion;

    /** @var Permiso[] */
    public array $permisos = array();

    public function __construct()
    {
        parent::__construct();
        if (!empty($this->id)) {
            $this->permisos = Permiso::listarPorRelacion($this->id, get_class());
        }
    }

    public function registrar() : bool
    {
        $query = "INSERT INTO rol (nombre, descripcion)
            VALUES (:nombre, :descripcion)";
            
        try {
            $this->db->pdo()->beginTransaction();
            $modulos = Modulo::listar();

            // Registra el rol
            $stmt = $this->prepare($query);
            $stmt->bindValue("nombre", $this->nombre);
            $stmt->bindValue("descripcion", $this->descripcion);

            $stmt->execute();
            $idRol = $this->db->pdo()->lastInsertId();

            // Crea permisos del rol
            $sql = "INSERT INTO permiso(idRol, idModulo)
                VALUES(:idRol, :idModulo)";

            $stmt = $this->prepare($sql);

            foreach ($modulos as $modulo) {
                $stmt->bindParam("idRol", $idRol);
                $stmt->bindParam("idModulo", $modulo->id);

                $stmt->execute();
            }

            // Guarda los cambios
            $this->db->pdo()->commit();

            return true;
        } catch (\Throwable $th) {
            $_SESSION['errores'][] = "Ocurrio un error al registrar el rol";
            return false;
        }
    }

    public function tienePermiso(string $modulo, string $permiso) : bool
    {
        $permiso = "get".ucfirst($permiso);
        
        foreach ($this->permisos as $p) {
            if ($p->modulo->getNombre() == strtolower($modulo) && $p->$permiso()) {
                return true;
            }
        }
        return false;
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
}