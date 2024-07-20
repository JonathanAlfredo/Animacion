<?php
require_once 'controller/Database.php';

$pdo = Database::getInstance();

try {
    $stmt = $pdo->query('SELECT * FROM Usuario');
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        echo 'ID: ' . $row['idPersona'] . ' - Nombre: ' . $row['pass'] . '<br>';
    }
} catch (PDOException $e) {
    echo 'Query failed: ' . $e->getMessage();
}

?>
