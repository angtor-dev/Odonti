<?php
require_once "Models/Model.php";
require_once "Models/Rol.php";
require_once "Models/Bitacora.php";

class Estudiante extends Model
{
    public int $idRol;
    private string $pnf;
    private string $nombre;
    private string $apellido;
    private int $estado;
    private string $clave;
    public ?Rol $rol;
    
    public function __construct()
    {
        parent::__construct();
        if (!empty($this->idRol)) {
            $this->rol = Rol::cargar($this->idRol);
        }
    }

    // public static function login(string $correo, string $clave) : bool
    // {
    //     if (empty($correo) || empty($clave)) {
    //         return false;
    //     }

    //     $usuario = Usuario::cargarPorCorreo($correo);

    //     if (is_null($usuario) || !$usuario->validarClave($clave)) {
    //         return false;
    //     }

    //     session_start();
    //     $_SESSION['usuario'] = $usuario;

    //     return true;
    // }

    // private function validarClave(string $clave) : bool
    // {
    //     return password_verify($clave, $this->clave);
    // }

    // public static function cargarPorCorreo(string $correo, int $estado = 1) : Usuario | null
    // {
    //     $bd = Database::getInstance();
    //     $query = "SELECT * FROM usuario WHERE correo = :correo AND estado = :estado";
        
    //     $stmt = $bd->pdo()->prepare($query);
    //     $stmt->bindValue("correo", $correo);
    //     $stmt->bindValue("estado", $estado);

    //     $stmt->execute();
    //     $stmt->setFetchMode(PDO::FETCH_CLASS, "Usuario");

    //     if ($stmt->rowCount() == 0) {
    //         return null;
    //     }
    //     return $stmt->fetch();
    // }

    // /** @return array<self> */
    // public static function listarPorRol(int $idRol, int $estado = null) : array
    // {
    //     $bd = Database::getInstance();
    //     $query = "SELECT * FROM usuario WHERE idRol = $idRol" . (isset($estado) ? " AND estado = $estado" : "");

    //     $stmt = $bd->pdo()->query($query);
    //     $stmt->setFetchMode(PDO::FETCH_CLASS, "Usuario");

    //     if ($stmt->rowCount() == 0) {
    //         return array();
    //     }
    //     return $stmt->fetchAll();
    // }

    public function registrar() : bool
    {
        $query = "INSERT INTO usuario (idRol, nombre, apellido, correo, clave)
            VALUES (:idRol, :nombre, :apellido, :correo, :clave)";
            
        try {
            $stmt = $this->prepare($query);
            $stmt->bindValue("idRol", $this->idRol);
            $stmt->bindValue("nombre", $this->nombre);
            $stmt->bindValue("apellido", $this->apellido);
            $stmt->bindValue("correo", $this->correo);
            $stmt->bindValue("clave", password_hash($this->clave, PASSWORD_DEFAULT));

            $stmt->execute();

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function actualizar() : bool
    {
        $query = "UPDATE usuario SET idRol = :idRol, nombre = :nombre,
            apellido = :apellido, correo = :correo WHERE id = :id";
            
        try {
            $stmt = $this->prepare($query);
            $stmt->bindValue("idRol", $this->idRol);
            $stmt->bindValue("nombre", $this->nombre);
            $stmt->bindValue("apellido", $this->apellido);
            $stmt->bindValue("correo", $this->correo);
            $stmt->bindValue("id", $this->id);

            $stmt->execute();

            return true;
        } catch (\Throwable $th) {
            if (DEVELOPER_MODE) debug($th);
            return false;
        }
    }

    public function mapearFormulario() : bool
    {
        try {
            $this->idRol = $_POST['idRol'];
            $this->nombre = $_POST['nombre'];
            $this->apellido = $_POST['apellido'];
            $this->correo = $_POST['correo'];
            if (!empty($_POST['id'])) {
                $this->id = $_POST['id'];
            } else {
                $this->clave = $_POST['clave'];
            }

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    // Getters
    public function getNombreCompleto() : string {
        return $this->nombre." ".$this->apellido;
    }
    
    public function getCorreo() : string {
        return $this->correo;
    }
    public function getNombre() : string {
        return $this->nombre;
    }
    public function getApellido() : string {
        return $this->apellido;
    }
    public function getEstado() : int {
        return $this->estado;
    }
}