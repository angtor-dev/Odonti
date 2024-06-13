<?php
require_once "Models/Model.php";

class Estudiante extends Model
{
    public int $idPaciente;
    private string $pnf;
    private int $trayecto;
    private int $fase;
    private string $seccion;
    private string $estado;
    public ?Paciente $paciente;
    
    public function __construct()
    {
        parent::__construct();
        if (!empty($this->idPaciente)) {
            $this->paciente = Paciente::cargar($this->idPaciente);
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
        $query = "INSERT INTO estudiante (idPaciente, pnf, trayecto, fase, seccion)
            VALUES (:idPaciente, :pnf, :trayecto, :fase, :seccion)";
            
        try {
            $stmt = $this->prepare($query);
            $stmt->bindValue("idPaciente", $this->idPaciente);
            $stmt->bindValue("pnf", $this->pnf);
            $stmt->bindValue("trayecto", $this->trayecto);
            $stmt->bindValue("fase", $this->fase);
            $stmt->bindValue("seccion", $this->seccion);

            $stmt->execute();

            return true;
        } catch (\Throwable $th) {
            if (true) debug($th);
            return false;
        }
    }

    public function actualizar() : bool
    {
        $query = "UPDATE estudiante SET idPaciente = :idPaciente, pnf = :pnf,
            trayecto = :trayecto, fase = :fase, seccion = :seccion WHERE id = :id";
            
        try {
            $stmt = $this->prepare($query);
            $stmt->bindValue("idPaciente", $this->idPaciente);
            $stmt->bindValue("pnf", $this->pnf);
            $stmt->bindValue("trayecto", $this->trayecto);
            $stmt->bindValue("fase", $this->fase);
            $stmt->bindValue("seccion", $this->seccion);
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
            $this->idPaciente = $_POST['idPaciente'];
            $this->pnf = $_POST['pnf'];
            $this->trayecto = $_POST['trayecto'];
            $this->fase = $_POST['fase'];
            $this->seccion = $_POST['seccion'];
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
    public function getIdPaciente() : string {
        return $this->idPaciente;
    }
    
    public function getPnf() : string {
        return $this->pnf;
    }
    public function getTrayecto() : string {
        return $this->trayecto;
    }
    public function getFase() : string {
        return $this->fase;
    }
    public function getSeccion() : int {
        return $this->seccion;
    }
    public function getEstado() : int {
        return $this->estado;
    }
}