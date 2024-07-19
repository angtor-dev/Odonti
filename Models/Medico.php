<?php
require_once "Models/Model.php";
require_once "Models/Especialidad.php";

class Medico extends Model
{
    // public int $idRol;
    private string $cedula;
    private string $nombre;
    private string $apellido;
    private string $direccion;
    private string $telefono;
    private string $correo;
    private int $estado;
    /** @var Especialidad[] */
    public array $especialidades;

    public function __construct()
    {
        parent::__construct();
        if (!empty($this->id)) {
            $this->especialidades = Especialidad::listarPorRelacionIntermedia($this->id, get_class(), 'medicoespecialidad');
        }
    }

    public function registrar() : bool
    {
        $query = "INSERT INTO medico (cedula, nombre, apellido, direccion, telefono, correo)
            VALUES (:cedula, :nombre, :apellido, :direccion, :telefono, :correo)";
            
        try {
            $this->db->connect();
            $this->db->pdo()->beginTransaction();

            $stmt = $this->prepare($query);
            $stmt->bindValue("cedula", $this->cedula);
            $stmt->bindValue("nombre", $this->nombre);
            $stmt->bindValue("apellido", $this->apellido);
            $stmt->bindValue("direccion", $this->direccion);
            $stmt->bindValue("telefono", $this->telefono);
            $stmt->bindValue("correo", $this->correo);

            $stmt->execute();

            if (empty($this->especialidades)) {
                $idMedico = $this->db->pdo()->lastInsertId();
                $idEspecilidad = 0;

                $query = "INSERT INTO medicoespecialidad (idMedico, idEspecialidad)
                    VALUES (:idMedico, :idEspecialidad)";

                $stmt = $this->prepare($query);
                $stmt->bindValue("idMedico", $idMedico);
                $stmt->bindParam("idEspecialidad", $idEspecilidad);

                foreach ($this->especialidades as $especialidad) {
                    $idEspecilidad = $especialidad->id;
                    $stmt->execute();
                }
            }

            $this->db->pdo()->commit();
            
            $this->db->disconnect();

            return true;
        } catch (\Throwable $th) {
            if ($this->db->pdo()->inTransaction()) {
                $this->db->pdo()->rollBack();
            }
            $_SESSION['errores'][] = $th->getMessage();
            return false;
        }
    }

    public function actualizar() : bool
    {
        $query = "UPDATE medico SET cedula = :cedula, nombre = :nombre,
            apellido = :apellido, direccion = :direccion, telefono = :telefono,
            correo = :correo WHERE id = :id";
            
        try {
            $this->db->connect();
            $this->db->pdo()->beginTransaction();

            $stmt = $this->prepare($query);
            $stmt->bindValue("cedula", $this->cedula);
            $stmt->bindValue("nombre", $this->nombre);
            $stmt->bindValue("apellido", $this->apellido);
            $stmt->bindValue("direccion", $this->direccion);
            $stmt->bindValue("telefono", $this->telefono);
            $stmt->bindValue("correo", $this->correo);
            $stmt->bindValue("id", $this->id);

            $stmt->execute();

            $idMedico = $this->id;
            $idEspecilidad = 0;

            $query = "DELETE FROM medicoespecialidad WHERE idMedico = $idMedico";
            $stmt = $this->prepare($query);
            $stmt->execute();

            if (empty($this->especialidades)) {
                $query = "INSERT INTO medicoespecialidad (idMedico, idEspecialidad)
                    VALUES (:idMedico, :idEspecialidad)";
    
                $stmt = $this->prepare($query);
                $stmt->bindValue("idMedico", $idMedico);
                $stmt->bindParam("idEspecialidad", $idEspecilidad);
                
                foreach ($this->especialidades as $especialidad) {
                    $idEspecilidad = $especialidad->id;
                    $stmt->execute();
                }
            }

            $this->db->pdo()->commit();
            
            $this->db->disconnect();

            return true;
        } catch (\Throwable $th) {
            if ($this->db->pdo()->inTransaction()) {
                $this->db->pdo()->rollBack();
            }
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
            $this->direccion = $_POST['direccion'];
            $this->telefono = $_POST['telefono'];
            $this->correo = $_POST['correo'];
            if (!empty($_POST['id'])) {
                $this->id = $_POST['id'];
            }
            if (!empty($_POST['especialidades'])) {
                foreach ($_POST['especialidades'] as $especialidad) {
                    $this->especialidades[] = Especialidad::cargar($especialidad);
                }
            }

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function tieneEspecialidad(Especialidad $especialidad) : bool {
        foreach ($this->especialidades as $e) {
            if ($e->id == $especialidad->id) {
                return true;
            }
        }
        return false;
    }

    public function esValido() : bool
    {
        if (empty(trim($this->cedula))) {
            $_SESSION['errores'][] = "El campo 'Cedula' es obligatorio";
            return false;
        }
        if (!preg_match(REG_NUMERICO, $this->cedula)) {
            $_SESSION['errores'][] = "El campo 'Cedula' solo puede contener números";
            return false;
        }
        if (empty(trim($this->nombre))) {
            $_SESSION['errores'][] = "El campo 'Nombre' es obligatorio";
            return false;
        }
        if (!preg_match(REG_ALFANUMERICO, $this->nombre)) {
            $_SESSION['errores'][] = "El campo 'Nombre' solo puede contener letras y números";
            return false;
        }
        if (empty(trim($this->apellido))) {
            $_SESSION['errores'][] = "El campo 'Apellido' es obligatorio";
            return false;
        }
        if (!preg_match(REG_ALFANUMERICO, $this->apellido)) {
            $_SESSION['errores'][] = "El campo 'Apellido' solo puede contener letras y números";
            return false;
        }
        if (empty(trim($this->direccion))) {
            $_SESSION['errores'][] = "El campo 'Direccion' es obligatorio";
            return false;
        }
        if (!preg_match(REG_ALFANUMERICO, $this->direccion)) {
            $_SESSION['errores'][] = "El campo 'Direccion' solo puede contener letras y números";
            return false;
        }
        if (empty(trim($this->correo))) {
            $_SESSION['errores'][] = "El campo 'Correo' es obligatorio";
            return false;
        }
        return true;
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
    
    public function getDirecion() : string {
        return $this->direccion;
    }
    public function getTelefono() : string {
        return $this->telefono;
    }
    public function getCorreo() : string {
        return $this->correo;
    }
    public function getEstado() : int {
        return $this->estado;
    }
}