<?php
require_once 'Database.php';

class ExpedienteDAO {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance();
    }

    public function insertarExpediente($idPersona) {
        try {
            $sql = "INSERT INTO expediente (idPersona) 
                    VALUES (:idPersona)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':idPersona', $idPersona);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function actualizarTutorCarrera($idPersona,$idTutor,$idCarrera) {
        try {
            $sql = "UPDATE expediente Set idTutor = :idTutor, idCarrera = :idCarrera WHERE idPersona = :idPersona";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':idTutor', $idTutor);
            $stmt->bindParam(':idCarrera', $idCarrera);
            $stmt->bindParam(':idPersona', $idPersona);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function actualizarDatosEm($idPersona,$nss,$clinica,$direccion) {
        try {
            $sql = "UPDATE expediente Set nss = :nss, clinica = :clinica, direccion = :direccion WHERE idPersona = :idPersona";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':nss', $nss);
            $stmt->bindParam(':clinica', $clinica);
            $stmt->bindParam(':direccion', $direccion);
            $stmt->bindParam(':idPersona', $idPersona);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    
    public function actualizarDatosExpediente($idPersona, $fechaNacimiento, $idEstadoCivil, $tipoSangre, $condMedicas) {
        try {
            $sql = "UPDATE expediente Set fechaNacimiento = :fechaNacimiento, idEstadoCivil = :idEstadoCivil, tipoSangre = :tipoSangre, condMedicas = :condMedicas WHERE idPersona = :idPersona";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':fechaNacimiento', $fechaNacimiento);
            $stmt->bindParam(':idEstadoCivil', $idEstadoCivil);
            $stmt->bindParam(':tipoSangre', $tipoSangre);
            $stmt->bindParam(':condMedicas', $condMedicas);
            $stmt->bindParam(':idPersona', $idPersona);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    
    public function actualizarConstancia($idPersona,$vigenciaDerechos) {
        try {
            $sql = "UPDATE expediente Set vigenciaDerechos = :vigenciaDerechos WHERE idPersona = :idPersona";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':vigenciaDerechos', $vigenciaDerechos);
            $stmt->bindParam(':idPersona', $idPersona);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }


    
}
?>