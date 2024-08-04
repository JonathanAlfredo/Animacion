<?php
require_once 'Database.php';

class AsistenciaDAO {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance();
    }

    public function insertarAsistencia($idEvento, $idPersona) {
        try {
            $sql = "INSERT INTO asistencia (idEvento, idPersona, entrada) 
             VALUES (:idEvento, :idPersona, NOW())";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':idEvento', $idEvento);
            $stmt->bindParam(':idPersona', $idPersona);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    
    public function registrarSalida($idEvento, $idPersona) {
        try {
            $sql = "UPDATE asistencia SET salida = NOW()
            WHERE idEvento = :idEvento AND idPersona = :idPersona";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':idEvento', $idEvento);
            $stmt->bindParam(':idPersona', $idPersona);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    

    
}
?>