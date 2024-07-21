<?php
require_once 'Database.php';

class PersonaDAO {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance();
    }

    public function insertarPersona($idPersona,$nombre, $appat, $apmat, $telefono, $correo, $sexo, $idTipoPersona) {
        try {
            $sql = "INSERT INTO Persona(idPersona,nombre, apPaterno, apMaterno, telefono, correo, sexo, idTipoPersona) 
                    VALUES (:idPersona, :nombre, :appat, :apmat, :telefono, :correo, :sexo, :idTipoPersona)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':idPersona', $idPersona);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':appat', $appat);
            $stmt->bindParam(':apmat', $apmat);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':sexo', $sexo);
            $stmt->bindParam(':idTipoPersona', $idTipoPersona);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
?>