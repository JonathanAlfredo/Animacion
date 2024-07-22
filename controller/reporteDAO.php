<?php
require_once 'Database.php';

class ReporteDAO {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance();
    }

    public function insertarReporte($idPersona, $idReportante, $comentarios, $ubicacion, $idTipoIncidente) {
        try {
            $sql = "INSERT INTO reporte (idPersona, idReportante, fechaHora, comentarios, ubicacion, idTipoIncidente, estado ) 
             VALUES (:idPersona, :idReportante, NOW(), :comentarios, :ubicacion, :idTipoIncidente, 'Nuevo')";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':idPersona', $idPersona);
            $stmt->bindParam(':idReportante', $idReportante);
            $stmt->bindParam(':comentarios', $comentarios);
            $stmt->bindParam(':ubicacion', $ubicacion);
            $stmt->bindParam(':idTipoIncidente', $idTipoIncidente);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    
    public function actualizarEstado($idReporte, $estado) {
        try {
            $sql = "UPDATE reporte Set estado = :estado WHERE idReporte = :idReporte";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':estado', $estado);
            $stmt->bindParam(':idReporte', $idReporte);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    
}
?>