<?php
include 'personaDAO.php';

$personaDAO = new PersonaDAO();

if (isset($_POST['matricula'])) {
    
    $result = $personaDAO -> obtenerNombre($_POST['matricula']);

    if ($result) {
        echo json_encode(['nombre' => $result]);
    } else {
        echo json_encode(['nombre' => $_POST['matricula']]);
    }
} else {
    echo json_encode(['nombre' => 'Matrícula no proporcionada']);
}
?>
