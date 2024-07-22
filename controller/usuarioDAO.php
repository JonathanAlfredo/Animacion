<?php
require_once 'Database.php';

class UsuarioDAO {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance();
    }

    public function insertarUsuario($idPersona, $pass, $idRol) {
        try {
            $hash = password_hash($pass, PASSWORD_DEFAULT); 
            $sql = "INSERT INTO usuario (idPersona, pass, idRol) VALUES (:idPersona, :pass, :idRol)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':idPersona', $idPersona);
            $stmt->bindParam(':pass', $hash);
            $stmt->bindParam(':idRol', $idRol);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function actualizarImagen($idPersona,$imagen) {
        try {
            $sql = "UPDATE usuario SET imagen = :imagen WHERE idPersona = :idPersona";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':imagen', $imagen);
            $stmt->bindParam(':idPersona', $idPersona);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function autenticarUsuario($idPersona, $pass) {
        try {
            $sql = "SELECT * FROM usuario WHERE idPersona = :idPersona";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':idPersona', $idPersona);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($result) {
                if (password_verify($pass, $result['pass'])) {
                    session_start();
                    $_SESSION['idPersona'] = $idPersona;
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    

}
?>