<?php
require_once "Models/Model.php";
require_once "Models/Rol.php";
require_once "Models/Bitacora.php";

class Paciente extends Model
{
    // public int $idRol;
    private string $cedula;
    private string $nombre;
    private string $apellido;
    private string $genero;
    private string $fechaNacimiento;
    private string $direccion;
    private string $estado;
    // public ?Rol $rol;
    
    // public function __construct()
    // {
    //     parent::__construct();
    //     if (!empty($this->idRol)) {
    //         $this->rol = Rol::cargar($this->idRol);
    //     }
    // }

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
        $query = "INSERT INTO paciente (cedula, nombre, apellido, genero, fechaNacimiento, direccion)
            VALUES (:cedula, :nombre, :apellido, :genero, :fechaNacimiento, :direccion)";
            
        try {
            $stmt = $this->prepare($query);
            $stmt->bindValue("cedula", $this->cedula);
            $stmt->bindValue("nombre", $this->nombre);
            $stmt->bindValue("apellido", $this->apellido);
            $stmt->bindValue("genero", $this->genero);
            $stmt->bindValue("fechaNacimiento", $this->fechaNacimiento);
            $stmt->bindValue("direccion", $this->direccion);

            $stmt->execute();

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function actualizar() : bool
    {
        $query = "UPDATE paciente SET cedula = :cedula, nombre = :nombre,
            apellido = :apellido, genero = :genero, fechaNacimiento = :fechaNacimiento, direccion = :direccion WHERE id = :id";
            
        try {
            $stmt = $this->prepare($query);
            $stmt->bindValue("cedula", $this->cedula);
            $stmt->bindValue("nombre", $this->nombre);
            $stmt->bindValue("apellido", $this->apellido);
            $stmt->bindValue("genero", $this->genero);
            $stmt->bindValue("fechaNacimiento", $this->fechaNacimiento);
            $stmt->bindValue("direccion", $this->direccion);
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
            $this->cedula = $_POST['cedula'];
            $this->nombre = $_POST['nombre'];
            $this->apellido = $_POST['apellido'];
            $this->genero = $_POST['genero'];
            $this->fechaNacimiento = $_POST['fechaNacimiento'];
            $this->direccion = $_POST['direccion'];
            if (!empty($_POST['id'])) {
                $this->id = $_POST['id'];
            }
            // else {
            //     $this->clave = $_POST['clave'];
            // }

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    // Getters
    public function getCedula() : string {
        return $this->cedula;
    }
    public function getNombreCompleto() : string {
        return $this->nombre." ".$this->apellido;
    }
    public function getNombre() : string {
        return $this->nombre;
    }
    public function getApellido() : string {
        return $this->apellido;
    }
    
    public function getGenero() : string {
        return $this->genero;
    }
    public function getFechaNacimiento() : string {
        return $this->fechaNacimiento;
    }
    public function getDireccion() : string {
        return $this->direccion;
    }
    public function getEstado() : int {
        return $this->estado;
    }
}