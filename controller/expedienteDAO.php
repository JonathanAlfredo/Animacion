<?php
require_once 'Database.php';

class ExpedienteDAO {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance();
    }

    public function insertarExpediente($idPersona, $nss, $vigenciaDerechos, $tipoSangre, $fechaNacimiento, $direccion, $condMedicas, $clinica, $idEstadoCivil, $idCarrera, $idTutor) {
        try {
            $sql = "INSERT INTO Expediente (idPersona) 
                    VALUES (:idPersona)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':idPersona', $idPersona);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    
}
?>