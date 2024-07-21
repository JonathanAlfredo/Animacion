<?php
require_once 'Database.php';

class ExpedienteDAO {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance();
    }

    public function insertarExpediente($idPersona) {
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

    public function actualizarTutorCarrera($idPersona,$idTutor,$idCarrera) {
        try {
            $sql = "UPDATE Expediente Set idTutor = :idTutor, idCarrera = :idCarrera WHERE idPersona = :idPersona";
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

    
}
?>