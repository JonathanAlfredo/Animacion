<?php
require_once 'Database.php';

class EventoDAO {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance();
    }

    public function insertarEvento($idEncargado, $descripcion, $fecha) {
        try {
            $sql = "INSERT INTO evento (descripcion, fecha, idEncargado) 
             VALUES (:descripcion, :fecha, :idEncargado)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':fecha', $fecha);
            $stmt->bindParam(':idEncargado', $idEncargado);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function obtenerId($idEncargado,$fecha) {
        try {
            $sql = "SELECT idEvento FROM evento e WHERE idEncargado = :idEncargado AND fecha = :fecha";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':idEncargado', $idEncargado);
            $stmt->bindParam(':fecha', $fecha);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($result && isset($result['idEvento'])) {
                return $result['idEvento'];
            } else {
                return null; 
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    
    

    
}
?>