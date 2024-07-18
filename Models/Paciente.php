<?php
require_once "Models/Model.php";
require_once "Models/Estudiante.php";
require_once "Models/Antecedente.php";

class Paciente extends Model
{
    private string $cedula;
    private string $nombre;
    private string $apellido;
    private string $genero;
    private string $fechaNacimiento;
    private string $direccion;
    private int $estado;
    public ?Estudiante $estudiante;
    /** @var Antecedente[] */
    public array $antecedentes;

    public function __construct()
    {
        parent::__construct();
        if (!empty($this->id)) {
            $this->estudiante = Estudiante::listarPorRelacion($this->id, get_class(), 1)[0] ?? null;
        }
        if (!empty($this->id)) {
            $this->antecedentes = Antecedente::listarPorRelacionIntermedia($this->id, get_class(), "pacienteantecedente");
        }
    }

    /**
     * Lista todos los pacientes cuyo nombre empiece por una letra especificada
     * @param string $letra
     * @param int $estado
     * @return Paciente[]
     */
    public static function filtrarPorLetra(string $letra = null, int $estado = null) : array
    {
        if (empty($letra)) {
            return Paciente::listar($estado);
        }

        $bd = Database::getInstance();
        $query = "SELECT * FROM paciente WHERE nombre LIKE '$letra%'"
            . (isset($estado) ? " AND estado = $estado" : "");

        try {
            $bd->connect();

            $stmt = $bd->pdo()->query($query);
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Paciente');

            $bd->disconnect();

            if ($stmt->rowCount() == 0) {
                return array();
            }
            return $stmt->fetchAll();
        } catch (\Throwable $th) {
            if (DEVELOPER_MODE) debug($th);
            $_SESSION['errores'][] = "Ha ocurrido un error al filtrar a los pacientes.";
            return array();
        }
    }

    public function registrar() : bool
    {
        $query = "INSERT INTO paciente (cedula, nombre, apellido, genero, fechaNacimiento, direccion)
            VALUES (:cedula, :nombre, :apellido, :genero, :fechaNacimiento, :direccion)";
            
        try {
            $this->db->connect();

            $stmt = $this->prepare($query);
            $stmt->bindValue("cedula", $this->cedula);
            $stmt->bindValue("nombre", $this->nombre);
            $stmt->bindValue("apellido", $this->apellido);
            $stmt->bindValue("genero", $this->genero);
            $stmt->bindValue("fechaNacimiento", $this->fechaNacimiento);
            $stmt->bindValue("direccion", $this->direccion);

            $stmt->execute();
            
            $this->db->disconnect();

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
            $this->db->connect();

            $stmt = $this->prepare($query);
            $stmt->bindValue("cedula", $this->cedula);
            $stmt->bindValue("nombre", $this->nombre);
            $stmt->bindValue("apellido", $this->apellido);
            $stmt->bindValue("genero", $this->genero);
            $stmt->bindValue("fechaNacimiento", $this->fechaNacimiento);
            $stmt->bindValue("direccion", $this->direccion);
            $stmt->bindValue("id", $this->id);

            $stmt->execute();
            
            $this->db->disconnect();

            return true;
        } catch (\Throwable $th) {
            if (DEVELOPER_MODE) debug($th);
            return false;
        }
    }

    public function esEstudiante() : bool
    {
        return !empty($this->estudiante);
    }

    public function tieneAntecedente(Antecedente $antecedente) : bool {
        if (empty($antecedente)) {
            return false;
        }

        foreach ($this->antecedentes as $antecedenteActual) {
            if ($antecedenteActual->id == $antecedente->id) {
                return true;
            }
        }

        return false;
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

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    // Getters
    public function getEdad() : int {
        $fechaNacimiento = new DateTime($this->fechaNacimiento);
        $fechaActual = new DateTime('now');
        
        $diferencia = $fechaActual->diff($fechaNacimiento);
        $edad = $diferencia->y;
        
        return $edad;
    }
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
    public function getFechaNacimientoFormateada() : string {
        return date_format(date_create($this->fechaNacimiento), "d/m/Y");
    }
    public function getDireccion() : string {
        return $this->direccion;
    }
    public function getEstado() : int {
        return $this->estado;
    }
}