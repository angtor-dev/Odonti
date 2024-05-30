<?php
require_once "Models/Model.php";
require_once "Models/Rol.php";

class Usuario extends Model
{
    public int $id;
    public int $idRol;
    public string $correo;
    public string $nombre;
    public string $apellido;
    public int $estado;
    private string $clave;
    public ?Rol $rol;
    
    public function __construct()
    {
        parent::__construct();
        $this->rol = Rol::cargar($this->idRol);
    }

    public static function login(string $correo, string $clave) : bool
    {
        if (empty($correo) || empty($clave)) {
            return false;
        }

        $usuario = Usuario::cargarPorCorreo($correo);

        if (is_null($usuario) || !$usuario->validarClave($clave)) {
            return false;
        }

        session_start();
        $_SESSION['usuario'] = $usuario;

        return true;
    }

    private function validarClave(string $clave) : bool
    {
        return password_verify($clave, $this->clave);
    }

    public static function cargarPorCorreo(string $correo, int $estado = 1) : Usuario | null
    {
        $bd = Database::getInstance();
        $query = "SELECT * FROM usuario WHERE correo = :correo AND estado = :estado";
        
        $stmt = $bd->pdo()->prepare($query);
        $stmt->bindValue("correo", $correo);
        $stmt->bindValue("estado", $estado);

        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, "Usuario");

        if ($stmt->rowCount() == 0) {
            return null;
        }
        return $stmt->fetch();
    }
}